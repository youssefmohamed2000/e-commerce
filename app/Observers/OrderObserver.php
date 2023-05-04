<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{

    public function updated(Order $order)
    {
        if ($order->status == 'delivered') {
            foreach ($order->orderItems as $item) {
                $new_quantity = $item->product->quantity - $item->quantity;
                $item->product->update([
                    'quantity' => $new_quantity
                ]);
            }
            $order->transaction->update([
                'status' => 'approved'
            ]);
        }
    }
}
