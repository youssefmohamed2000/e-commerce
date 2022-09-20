<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::query()->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
        $total_sales = Order::query()->where('status', 'delivered')
            ->count();
        $total_revenue = Order::query()->where('status', 'delivered')
            ->sum('total');
        $today_sales = Order::query()->where('status', 'delivered')
            ->whereDate('created_at', Carbon::today())
            ->count();
        $today_revenue = Order::query()->where('status', 'delivered')
            ->whereDate('created_at', Carbon::today())
            ->sum('total');
        return view('admin.home', compact('orders', 'total_sales', 'total_revenue', 'today_sales', 'today_revenue'));
    }
}
