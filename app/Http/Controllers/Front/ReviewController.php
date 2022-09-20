<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Models\OrderItem;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create($order_item_id)
    {
        $order_item = OrderItem::query()->findOrFail($order_item_id);
        return view('front.review.create', compact('order_item'));
    }

    public function store(StoreReviewRequest $request, $order_item_id)
    {
        $order_item = OrderItem::query()->findOrFail($order_item_id);
        $validated = $request->safe();
        if ($order_item) {
            Review::query()->create([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'order_item_id' => $order_item_id,
            ]);

            $order_item->review_status = true;
            $order_item->save();

            session()->flash('success', 'Review Added Successfully');
            return redirect()->route('orders.show', $order_item->order_id);
        }
    }
}
