<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Simple logic for reports page
        $tenantId = auth()->user()->tenant_id;
        $totalRevenue = Order::where('tenant_id', $tenantId)->where('payment_status', 'Paid')->sum('grand_total');
        $totalOrders = Order::where('tenant_id', $tenantId)->count();
        
        return view('owner.reports.index', compact('totalRevenue', 'totalOrders'));
    }
}
