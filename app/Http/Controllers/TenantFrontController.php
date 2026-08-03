<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantFrontController extends Controller
{
    public function index($tenant)
    {
        // Temukan tenant berdasarkan subdomain slug
        $tenant = Tenant::where('slug', $tenant)->firstOrFail();
        
        // Auto-create settings jika belum ada (tenant lama yang belum punya settings)
        $settings = $tenant->settings()->firstOrCreate(
            ['tenant_id' => $tenant->id],
            ['business_name' => $tenant->name, 'primary_color' => '#2563EB', 'font_family' => 'Inter']
        );

        // Render view berdasarkan niche tenant
        $viewName = "tenant.{$tenant->niche}.home";

        if (!view()->exists($viewName)) {
            abort(404, "Halaman publik untuk niche {$tenant->niche} belum tersedia.");
        }

        return view($viewName, compact('tenant', 'settings'));
    }
}
