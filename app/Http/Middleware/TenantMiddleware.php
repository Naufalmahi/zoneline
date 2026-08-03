<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * TenantMiddleware
 *
 * Middleware TERPENTING di Zoneline.
 * Memastikan setiap request dari Owner/Employee terikat pada tenant mereka.
 *
 * Flow:
 * Request → Auth → TenantMiddleware → Permission → Controller
 */
class TenantMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Super Admin tidak perlu filter tenant
        if ($user && $user->isSuperAdmin()) {
            return $next($request);
        }

        // Pastikan user punya tenant_id
        if (!$user || !$user->tenant_id) {
            abort(403, 'Akun Anda tidak terhubung ke tenant manapun.');
        }

        // Pastikan tenant masih aktif (tidak suspended/expired)
        $tenant = $user->tenant;

        if (!$tenant || $tenant->status === 'Suspended') {
            auth()->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun laundry Anda telah ditangguhkan. Hubungi admin Zoneline.']);
        }

        if ($tenant->status === 'Expired') {
            return redirect()->route('subscription.expired')
                ->withErrors(['subscription' => 'Masa langganan Anda telah berakhir. Silakan perpanjang.']);
        }

        // Share tenant ke seluruh view (dipakai navbar, sidebar, dsb)
        view()->share('currentTenant', $tenant);
        // Auto-create settings if missing to avoid null errors in views
        $settings = $tenant->settings()->firstOrCreate(
            ['tenant_id' => $tenant->id],
            ['business_name' => $tenant->name, 'primary_color' => '#2563EB', 'font_family' => 'Inter']
        );
        view()->share('currentTenantSettings', $settings);

        return $next($request);
    }
}
