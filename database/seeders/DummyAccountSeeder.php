<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Role;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada Plan
        $plan = Plan::firstOrCreate(
            ['slug' => 'basic'],
            [
                'name' => 'Basic',
                'price' => 39000,
                'max_orders' => 0,
                'max_employees' => 3,
                'trial_days' => 14,
                'is_active' => true,
            ]
        );

        // 1. Superadmin (No Tenant)
        User::updateOrCreate(
            ['email' => 'superadmin@zoneline.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123'),
                'email_verified_at' => now(),
                'uuid' => (string) Str::uuid(),
            ]
        );

        // Buat Roles (jika belum ada)
        $ownerRole = Role::firstOrCreate(['name' => 'owner', 'guard_name' => 'web']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee', 'guard_name' => 'web']);

        $niches = [
            'laundry' => [
                'email' => 'owner@laundry.com',
                'name' => 'Laundry Berkah',
                'slug' => 'laundry-berkah'
            ],
            'coffee' => [
                'email' => 'owner@coffee.com',
                'name' => 'Kopi Kenangan',
                'slug' => 'kopi-kenangan'
            ],
            'barbershop' => [
                'email' => 'owner@barber.com',
                'name' => 'Captain Barbershop',
                'slug' => 'captain-barber'
            ]
        ];

        foreach ($niches as $niche => $data) {
            $tenant = Tenant::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'niche' => $niche,
                    'status' => 'Active',
                ]
            );

            // Beri Subscription
            \App\Models\TenantSubscription::firstOrCreate(
                ['tenant_id' => $tenant->id],
                [
                    'plan_id' => $plan->id,
                    'status' => 'Active',
                    'starts_at' => now(),
                    'ends_at' => now()->addDays(14),
                ]
            );

            // Create Owner
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => 'Owner ' . ucfirst($niche),
                    'password' => Hash::make('123'),
                    'tenant_id' => $tenant->id,
                    'role_id' => $ownerRole->id,
                    'email_verified_at' => now(),
                    'uuid' => (string) Str::uuid(),
                ]
            );
        }

        // 4. Create one employee for laundry as an example
        $laundryTenant = Tenant::where('slug', 'laundry-berkah')->first();
        if ($laundryTenant) {
            User::updateOrCreate(
                ['email' => 'karyawan@laundry.com'],
                [
                    'name' => 'Siti Karyawan',
                    'password' => Hash::make('123'),
                    'tenant_id' => $laundryTenant->id,
                    'role_id' => $employeeRole->id,
                    'email_verified_at' => now(),
                    'uuid' => (string) Str::uuid(),
                ]
            );
        }
    }
}
