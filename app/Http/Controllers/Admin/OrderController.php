<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::query()->findOrFail($id);
        return view('admin.order.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::query()->findOrFail($id);
        if ($request->status == 'delivered') {
            $delivered_date = date('Y-m-d');
        } elseif ($request->status == 'canceled') {
            $canceled_date = date('Y-m-d');
        }

        $order->update([
            'status'          => $request->status,
            'delivered_date'  => $delivered_date ?? null,
            'canceled_date'   => $canceled_date ?? null,
        ]);

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.orders.index');
    }
}
