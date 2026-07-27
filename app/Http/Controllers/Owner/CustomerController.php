<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\Customer\CustomerService;
use Illuminate\Http\Request;

/**
 * CustomerController — TIPIS.
 *
 * Controller ini hanya:
 * 1. Menerima request
 * 2. Memanggil Service
 * 3. Mengembalikan response (view / redirect)
 *
 * TIDAK ADA business logic di sini.
 */
class CustomerController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService
    ) {}

    public function index(Request $request)
    {
        $customers = $this->customerService->paginate($request->all());
        return view('owner.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('owner.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = $this->customerService->store($request->validated());
        return redirect()->route('owner.customers.show', $customer)
            ->with('success', "Customer {$customer->name} berhasil ditambahkan.");
    }

    public function show(Customer $customer)
    {
        $customer->load(['orders' => fn($q) => $q->latest()->take(10), 'addresses']);
        return view('owner.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('owner.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->customerService->update($customer, $request->validated());
        return redirect()->route('owner.customers.show', $customer)
            ->with('success', 'Data customer berhasil diperbarui.');
    }

    public function destroy(Customer $customer)
    {
        try {
            $this->customerService->delete($customer);
            return redirect()->route('owner.customers.index')
                ->with('success', "Customer {$customer->name} berhasil dihapus.");
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
