<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $basic = Plan::firstOrCreate(
            ['slug' => 'basic'],
            [
                'name'          => 'Basic',
                'price'         => 39000,
                'max_orders'    => 0,
                'max_employees' => 3,
                'trial_days'    => 14,
                'is_active'     => true,
            ]
        );

        if ($basic->wasRecentlyCreated) {
            $basic->features()->createMany([
                ['feature_key' => 'unlimited_order', 'feature_label' => 'Unlimited Order'],
                ['feature_key' => 'customer_mgmt',   'feature_label' => 'Manajemen Pelanggan'],
                ['feature_key' => 'thermal_print',   'feature_label' => 'Cetak Nota (Thermal)'],
                ['feature_key' => 'excel_export',    'feature_label' => 'Ekspor Laporan Excel',   'is_available' => false],
                ['feature_key' => 'multi_employee',  'feature_label' => 'Akses Multi Karyawan',   'is_available' => false],
                ['feature_key' => 'wa_notification', 'feature_label' => 'Notifikasi WhatsApp',    'is_available' => false],
            ]);
        }

        $premium = Plan::firstOrCreate(
            ['slug' => 'premium'],
            [
                'name'          => 'Premium',
                'price'         => 79000,
                'max_orders'    => 0,
                'max_employees' => 10,
                'trial_days'    => 14,
                'is_active'     => true,
            ]
        );

        if ($premium->wasRecentlyCreated) {
            $premium->features()->createMany([
                ['feature_key' => 'unlimited_order', 'feature_label' => 'Unlimited Order'],
                ['feature_key' => 'customer_mgmt',   'feature_label' => 'Manajemen Pelanggan'],
                ['feature_key' => 'thermal_print',   'feature_label' => 'Cetak Nota (Thermal)'],
                ['feature_key' => 'excel_export',    'feature_label' => 'Ekspor Laporan Excel & Keuangan'],
                ['feature_key' => 'multi_employee',  'feature_label' => 'Akses Multi Karyawan'],
                ['feature_key' => 'wa_notification', 'feature_label' => 'Notifikasi WhatsApp Otomatis'],
                ['feature_key' => 'cloud_backup',    'feature_label' => 'Backup Cloud Aman'],
            ]);
        }
    }
}
