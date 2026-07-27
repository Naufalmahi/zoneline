<?php

namespace App\Helpers;

/**
 * InvoiceHelper
 *
 * Helper untuk format dan generate nomor invoice, nota, dsb.
 */
class InvoiceHelper
{
    /**
     * Format angka ke format rupiah: Rp 10.000
     */
    public static function formatRupiah(float|int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Format berat: 2.50 kg → "2.5 kg", 0.50 kg → "500 gr"
     */
    public static function formatWeight(float $kg): string
    {
        if ($kg < 1) {
            return round($kg * 1000) . ' gr';
        }
        return rtrim(rtrim(number_format($kg, 2, '.', ''), '0'), '.') . ' kg';
    }
}

/**
 * TenantHelper
 *
 * Helper untuk mengakses data tenant yang sedang aktif.
 */
class TenantHelper
{
    /**
     * Dapatkan nama bisnis tenant dari settings, atau fallback ke nama tenant.
     */
    public static function businessName(): string
    {
        $user = auth()->user();
        if (!$user || !$user->tenant) return 'Zoneline';

        return $user->tenant->settings?->business_name
            ?? $user->tenant->name;
    }

    /**
     * Dapatkan logo tenant, atau null jika belum diset.
     */
    public static function logoUrl(): ?string
    {
        $logo = auth()->user()?->tenant?->settings?->logo;
        return $logo ? asset('storage/' . $logo) : null;
    }
}
