<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['currentPrice', 'category'])
            ->where('tenant_id', auth()->user()->tenant_id)
            ->latest()
            ->paginate(15);
        return view('owner.services.index', compact('services'));
    }

    public function create()
    {
        return view('owner.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'unit_type' => 'required|string|in:kg,pcs,meter',
            'price' => 'required|numeric|min:0',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_type' => $request->unit_type,
            'is_active' => $request->has('is_active'),
        ]);

        $service->prices()->create([
            'tenant_id' => $service->tenant_id,
            'price' => $request->price,
            'effective_date' => now(),
        ]);

        return redirect()->route('owner.services.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Service $service)
    {
        return view('owner.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:service_categories,id',
            'unit_type' => 'required|string|in:kg,pcs,meter',
            'price' => 'required|numeric|min:0',
        ]);

        $service->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'unit_type' => $request->unit_type,
            'is_active' => $request->has('is_active'),
        ]);

        // If price changed, create new price log
        if ($service->currentPrice->price != $request->price) {
            $service->prices()->create([
                'tenant_id' => $service->tenant_id,
                'price' => $request->price,
                'effective_date' => now(),
            ]);
        }

        return redirect()->route('owner.services.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('owner.services.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
