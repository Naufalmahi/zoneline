<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * BaseService
 *
 * Kelas induk untuk semua Service di Zoneline.
 * Menyediakan method umum: logging, tenant helper, dsb.
 *
 * Prinsip: Controller hanya 5-15 baris. Semua logika ada di sini.
 */
abstract class BaseService
{
    /**
     * Catat aktivitas user ke tabel activity_logs.
     * Dipanggil setelah setiap aksi penting (create, update, delete).
     */
    protected function logActivity(string $activity, array $properties = []): void
    {
        try {
            ActivityLog::create([
                'tenant_id'  => Auth::user()?->tenant_id,
                'user_id'    => Auth::id(),
                'activity'   => $activity,
                'ip_address' => Request::ip(),
                'device'     => substr(Request::userAgent() ?? '', 0, 100),
                'properties' => !empty($properties) ? $properties : null,
            ]);
        } catch (\Throwable $e) {
            // Jangan sampai logging error menghentikan proses utama
            \Log::warning('Activity log failed: ' . $e->getMessage());
        }
    }

    /**
     * Dapatkan tenant_id user yang sedang login.
     */
    protected function tenantId(): ?int
    {
        return Auth::user()?->tenant_id;
    }

    /**
     * Dapatkan ID user yang sedang login.
     */
    protected function userId(): ?int
    {
        return Auth::id();
    }
}
