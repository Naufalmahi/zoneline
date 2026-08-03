<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('settings')->latest()->paginate(15);
        return view('superadmin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('superadmin.tenants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tenants,slug',
            'niche' => 'required|string|in:laundry,coffee,barbershop',
            'status' => 'required|string|in:Active,Trial,Inactive',
        ]);

        Tenant::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'niche' => $request->niche,
            'status' => $request->status,
        ]);

        return redirect()->route('superadmin.tenants.index')->with('success', 'Tenant berhasil ditambahkan!');
    }
}
