<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create permissions
        $permissions = [
            'create_order', 'edit_order', 'delete_order', 'view_order',
            'create_customer', 'edit_customer', 'delete_customer', 'view_customer',
            'create_service', 'edit_service', 'delete_service', 'view_service',
            'view_report', 'manage_employee', 'manage_settings', 'manage_subscription'
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 2. Create roles and assign permissions
        
        // Super Admin (Staff Zoneline SaaS) - gets all permissions via Gate::before in AuthServiceProvider usually
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);

        // Owner Laundry - Gets everything
        $owner = Role::firstOrCreate(['name' => 'owner']);
        $owner->givePermissionTo(Permission::all());

        // Employee Laundry (Kasir) - limited access
        $employee = Role::firstOrCreate(['name' => 'employee']);
        $employee->givePermissionTo([
            'create_order', 'view_order',
            'create_customer', 'view_customer',
        ]);
    }
}
