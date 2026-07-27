<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatusLog;
use App\Models\Customer;
use App\Models\OrderStatus;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * OrderService
 *
 * Jantung bisnis Zoneline. Semua logika order ada di sini.
 */
class OrderService extends BaseService
{
    /**
     * Buat order baru — harus selesai dalam < 30 detik (prinsip UX).
     *
     * Proses:
     * 1. Generate invoice_number unik per tenant
     * 2. Generate uuid untuk tracking URL publik
     * 3. Simpan header Order
     * 4. Simpan OrderDetails dengan price_at_that_time (snapshot harga)
     * 5. Hitung subtotal, tax, grand_total
     * 6. Catat status awal di order_status_logs
     * 7. Update cached counter di customers
     * 8. Catat activity log
     */
    public function store(array $data): Order
    {
        return DB::transaction(function () use ($data) {

            // 1. Ambil status awal (sequence paling kecil = "Received")
            $initialStatus = OrderStatus::where('tenant_id', $this->tenantId())
                ->orderBy('sequence')
                ->first();

            // 2. Hitung nilai keuangan dari details
            $financial = $this->calculateFinancials($data['details']);

            // 3. Buat header order
            $order = Order::create([
                'tenant_id'          => $this->tenantId(),
                'invoice_number'     => $this->generateInvoiceNumber(),
                'uuid'               => (string) Str::uuid(),
                'customer_id'        => $data['customer_id'],
                'employee_id'        => $this->userId(),
                'status_id'          => $initialStatus?->id,
                'subtotal'           => $financial['subtotal'],
                'discount'           => $data['discount'] ?? 0,
                'tax'                => $financial['tax'],
                'grand_total'        => $financial['grand_total'],
                'payment_status'     => 'Unpaid',
                'received_at'        => now(),
                'estimated_finish_at'=> $data['estimated_finish_at'] ?? null,
                'notes'              => $data['notes'] ?? null,
            ]);

            // 4. Simpan detail (snapshot harga)
            foreach ($data['details'] as $detail) {
                $order->details()->create([
                    'service_id'          => $detail['service_id'],
                    'service_name'        => $detail['service_name'],       // snapshot
                    'unit_type'           => $detail['unit_type'],          // snapshot
                    'qty'                 => $detail['qty'],
                    'price_at_that_time'  => $detail['price'],              // snapshot harga
                    'total_price'         => $detail['qty'] * $detail['price'],
                ]);
            }

            // 5. Catat status log awal
            if ($initialStatus) {
                OrderStatusLog::create([
                    'order_id'       => $order->id,
                    'status_id'      => $initialStatus->id,
                    'status_name'    => $initialStatus->name,
                    'changed_by'     => $this->userId(),
                    'changed_by_name'=> auth()->user()->name,
                    'notes'          => 'Order baru diterima',
                ]);
            }

            // 6. Update cached counter di customer
            Customer::withoutGlobalScope('tenant')
                ->where('id', $data['customer_id'])
                ->increment('total_orders');

            $this->logActivity("Membuat order baru: {$order->invoice_number}", [
                'order_id'       => $order->id,
                'invoice_number' => $order->invoice_number,
                'grand_total'    => $order->grand_total,
            ]);

            return $order->load(['customer', 'status', 'details']);
        });
    }

    /**
     * Update status order — dipanggil saat kasir/karyawan klik tombol status.
     */
    public function updateStatus(Order $order, int $statusId, ?string $notes = null): Order
    {
        return DB::transaction(function () use ($order, $statusId, $notes) {
            $newStatus = OrderStatus::findOrFail($statusId);
            $oldStatusName = $order->status?->name ?? 'N/A';

            $order->update(['status_id' => $statusId]);

            // Tandai waktu selesai jika status adalah final
            if ($newStatus->is_final && $newStatus->slug === 'picked_up') {
                $order->update([
                    'picked_up_at' => now(),
                    'payment_status' => 'Paid',
                ]);
                // Update total spending customer
                Customer::withoutGlobalScope('tenant')
                    ->where('id', $order->customer_id)
                    ->increment('total_spending', $order->grand_total);
            }

            if ($newStatus->slug === 'ready') {
                $order->update(['finished_at' => now()]);
            }

            // Catat log perubahan status
            OrderStatusLog::create([
                'order_id'        => $order->id,
                'status_id'       => $newStatus->id,
                'status_name'     => $newStatus->name,
                'changed_by'      => $this->userId(),
                'changed_by_name' => auth()->user()->name,
                'notes'           => $notes,
            ]);

            $this->logActivity("Update status order {$order->invoice_number}: {$oldStatusName} → {$newStatus->name}");

            return $order->fresh(['status', 'statusLogs']);
        });
    }

    /**
     * Generate invoice number unik per tenant: INV-2026-0001
     */
    private function generateInvoiceNumber(): string
    {
        $year   = now()->year;
        $prefix = 'INV-' . $year . '-';

        $latest = Order::withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenantId())
            ->whereYear('created_at', $year)
            ->orderByDesc('id')
            ->value('invoice_number');

        if (!$latest) {
            return $prefix . '0001';
        }

        $number = (int) substr($latest, -4);
        return $prefix . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Hitung subtotal, tax, grand_total dari detail order.
     */
    private function calculateFinancials(array $details): array
    {
        $subtotal = collect($details)->sum(fn($d) => $d['qty'] * $d['price']);

        // Ambil tax_rate dari tenant settings
        $taxRate = auth()->user()?->tenant?->settings?->tax_rate ?? 0;
        $tax     = $subtotal * ($taxRate / 100);

        return [
            'subtotal'    => $subtotal,
            'tax'         => round($tax, 2),
            'grand_total' => $subtotal + $tax,
        ];
    }
}
