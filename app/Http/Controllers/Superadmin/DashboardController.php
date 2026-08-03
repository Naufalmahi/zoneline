<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tenants'  => Tenant::count(),
            'active_tenants' => Tenant::where('status', 'Active')->count(),
            'trial_tenants'  => Tenant::where('status', 'Trial')->count(),
            'total_users'    => User::count(),
        ];

        $recentTenants = Tenant::with('settings', 'subscription')
            ->latest()
            ->take(10)
            ->get();

        return view('superadmin.dashboard', compact('stats', 'recentTenants'));
    }
}
