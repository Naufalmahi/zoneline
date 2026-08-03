<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        // Dalam MVP ini, role kita ambil semua atau bisa di-filter berdasar guard dll
        $roles = Role::whereNotIn('name', ['superadmin'])->get();
        return view('owner.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('owner.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'web']);

        return redirect()->route('owner.roles.index')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit(Role $role)
    {
        return view('owner.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('owner.roles.index')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy(Role $role)
    {
        if (in_array($role->name, ['owner', 'admin'])) {
            return back()->with('error', 'Role inti tidak bisa dihapus!');
        }
        $role->delete();
        return redirect()->route('owner.roles.index')->with('success', 'Role berhasil dihapus');
    }
}
