<?php

namespace App\Http\Controllers;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');

        return view('dashboard', compact('totalOrders', 'totalRevenue'));
    }
}
