<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $invoice = $request->query('invoice');
        $order = null;

        if ($invoice) {
            // Find order globally across all tenants
            $order = Order::withoutGlobalScope('tenant')
                ->with(['customer', 'status', 'statusLogs', 'tenant.settings'])
                ->where('invoice_number', $invoice)
                ->first();
        }

        return view('tracking', compact('order', 'invoice'));
    }
}
