<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * CustomerService
 *
 * Seluruh business logic seputar Customer ada di sini.
 * CustomerController hanya memanggil method ini.
 */
class CustomerService extends BaseService
{
    /**
     * Ambil daftar customer dengan filter dan pagination.
     * HasTenant Global Scope otomatis memfilter berdasarkan tenant_id.
     */
    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Customer::query()
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('member_code', 'like', "%{$search}%");
                });
            })
            ->latest();

        return $query->paginate($perPage)->withQueryString();
    }

    /**
     * Buat customer baru.
     *
     * Proses:
     * 1. Generate member_code unik dalam tenant
     * 2. Simpan ke database (tenant_id auto-fill via HasTenant)
     * 3. Catat di activity log
     */
    public function store(array $data): Customer
    {
        return DB::transaction(function () use ($data) {
            $data['member_code'] = $this->generateMemberCode();

            $customer = Customer::create($data);

            $this->logActivity("Menambahkan customer baru: {$customer->name}", [
                'customer_id'  => $customer->id,
                'member_code'  => $customer->member_code,
            ]);

            return $customer;
        });
    }

    /**
     * Update data customer.
     */
    public function update(Customer $customer, array $data): Customer
    {
        return DB::transaction(function () use ($customer, $data) {
            $oldName = $customer->name;
            $customer->update($data);

            $this->logActivity("Mengubah data customer: {$oldName}", [
                'customer_id' => $customer->id,
                'changes'     => $data,
            ]);

            return $customer->fresh();
        });
    }

    /**
     * Hapus customer (soft delete).
     * Tidak bisa hapus jika masih punya order aktif.
     */
    public function delete(Customer $customer): void
    {
        $activeOrders = $customer->orders()
            ->whereNotIn('payment_status', ['Paid'])
            ->count();

        if ($activeOrders > 0) {
            throw new \Exception("Customer tidak dapat dihapus karena masih memiliki {$activeOrders} order aktif.");
        }

        DB::transaction(function () use ($customer) {
            $customer->delete();
            $this->logActivity("Menghapus customer: {$customer->name}", [
                'customer_id' => $customer->id,
            ]);
        });
    }

    /**
     * Generate member code unik: CUS0001, CUS0002, dst.
     * Unik per tenant — Laundry A dan B bisa sama-sama punya CUS0001.
     */
    private function generateMemberCode(): string
    {
        $latest = Customer::withoutGlobalScope('tenant')
            ->where('tenant_id', $this->tenantId())
            ->orderByDesc('id')
            ->value('member_code');

        if (!$latest) {
            return 'CUS0001';
        }

        $number = (int) substr($latest, 3);
        return 'CUS' . str_pad($number + 1, 4, '0', STR_PAD_LEFT);
    }
}
