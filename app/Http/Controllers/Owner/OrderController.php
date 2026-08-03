<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use App\Services\Order\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService
    ) {}

    public function index()
    {
        $orders = \App\Models\Order::with(['customer', 'status'])
            ->where('tenant_id', auth()->user()->tenant_id)
            ->latest()
            ->paginate(20);
        return view('owner.orders.index', compact('orders'));
    }

    public function show(\App\Models\Order $order)
    {
        abort_unless($order->tenant_id === auth()->user()->tenant_id, 403);
        $order->load(['customer', 'status', 'details', 'statusLogs']);
        $statuses = \App\Models\OrderStatus::where('tenant_id', auth()->user()->tenant_id)->orderBy('sequence')->get();
        return view('owner.orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(\Illuminate\Http\Request $request, \App\Models\Order $order)
    {
        abort_unless($order->tenant_id === auth()->user()->tenant_id, 403);
        $request->validate(['status_id' => 'required|exists:order_statuses,id']);
        $this->orderService->updateStatus($order, $request->status_id, $request->notes);
        return back()->with('success', 'Status order berhasil diperbarui.');
    }

    public function create()
    {
        // Get active customers for the dropdown — scoped to this tenant
        $customers = Customer::where('tenant_id', auth()->user()->tenant_id)->orderBy('name')->get();
        
        // Get active services with their current price
        $services = Service::with('currentPrice')
            ->where('tenant_id', auth()->user()->tenant_id)
            ->where('is_active', true)
            ->get();
        
        return view('owner.orders.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'qty' => 'required|numeric|min:0.1',
            'notes' => 'nullable|string',
        ]);

        $service = Service::with('currentPrice')->findOrFail($validated['service_id']);

        $orderData = [
            'customer_id' => $validated['customer_id'],
            'notes' => $validated['notes'],
            'details' => [
                [
                    'service_id' => $service->id,
                    'service_name' => $service->name,
                    'unit_type' => $service->unit_type,
                    'qty' => $validated['qty'],
                    'price' => $service->currentPrice->price ?? 0,
                ]
            ]
        ];

        try {
            $order = $this->orderService->store($orderData);
            return redirect()->route('owner.orders.index')
                ->with('success', "Order {$order->invoice_number} berhasil dibuat.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
