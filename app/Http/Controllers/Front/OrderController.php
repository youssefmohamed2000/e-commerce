<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()->where('user_id', auth()->user()->id)->get();
        return view('front.order.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::query()->where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();
        return view('front.order.show', compact('order'));
    }

    public function update($id)
    {
        $order = Order::query()->findOrFail($id);

        $order->update([
            'status'          => 'canceled',
            'canceled_date'   => date('Y-m-d')
        ]);

        session()->flash('success', 'Updated Successfully');
        return redirect()->route('orders.show', $order->id);
    }
}
