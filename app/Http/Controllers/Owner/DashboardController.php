<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\OrderStatusLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        // Top Stats
        $todayOrdersCount = Order::where('tenant_id', $tenantId)
            ->whereDate('created_at', today())
            ->count();

        $todayRevenue = Order::where('tenant_id', $tenantId)
            ->whereDate('created_at', today())
            ->where('payment_status', 'Paid')
            ->sum('grand_total');

        $outstandingDebt = Order::where('tenant_id', $tenantId)
            ->where('payment_status', 'Unpaid')
            ->sum('grand_total');

        // Note: For 'Selesai Belum Diambil', we would ideally check the status. 
        // For now we assume status_id 4 is Ready (Selesai). If order statuses are dynamic, 
        // you might query by the sequence or name. We'll grab any that are not completed fully.
        $readyOrdersCount = Order::where('tenant_id', $tenantId)
            ->whereHas('status', function ($q) {
                $q->where('name', 'like', '%Ready%')->orWhere('name', 'like', '%Selesai%');
            })
            ->count();

        // Recent Orders
        $recentOrders = Order::with(['customer', 'status'])
            ->where('tenant_id', $tenantId)
            ->latest()
            ->take(5)
            ->get();

        // Recent Activities (Status logs)
        $recentActivities = OrderStatusLog::with(['order', 'changedBy'])
            ->whereHas('order', function ($q) use ($tenantId) {
                $q->where('tenant_id', $tenantId);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'todayOrdersCount',
            'todayRevenue',
            'outstandingDebt',
            'readyOrdersCount',
            'recentOrders',
            'recentActivities'
        ));
    }
}
