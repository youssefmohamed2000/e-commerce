<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderConfirmation;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Shipping;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function create()
    {
        $profile = Profile::query()->where('user_id', auth()->user()->id)->first();
        return view('front.checkout', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'line1' => 'required|string',
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
            'payment_method' => 'required',
        ]);
        if ($request->is_shipping_different == 1) {
            $request->validate([
                's_first_name' => 'required|string|max:100',
                's_last_name' => 'required|string|max:100',
                's_email' => 'required|email',
                's_mobile' => 'required|numeric',
                's_line1' => 'required|string',
                's_country' => 'required',
                's_province' => 'required',
                's_city' => 'required',
                's_zipcode' => 'required',
                'payment_method' => 'required',
            ]);
        }
        // if ($request->has('payment_method') && $request->payment_method == 'card') {
        //     $request->validate([
        //         'card_number'  => 'required|numeric',
        //         'exp_month'    => 'required|numeric',
        //         'exp_year'     => 'required|numeric',
        //         'cvc'          => 'required|numeric'
        //     ]);
        // }
        DB::beginTransaction();
        try {
            $order = Order::query()->create([
                'user_id' => auth()->user()->id,
                'subtotal' => session()->get('checkout')['subtotal'],
                'discount' => session()->get('checkout')['discount'],
                'tax' => session()->get('checkout')['tax'],
                'total' => session()->get('checkout')['total'],
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'line1' => $request->line1,
                'line2' => $request->line2 ?? null,
                'city' => $request->city,
                'province' => $request->province,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'status' => 'ordered',
                'is_shipping_different' => $request->is_shipping_different ?? 0
            ]);

            foreach (Cart::instance('cart')->content() as $item) {
                OrderItem::query()->create([
                    'product_id' => $item->id,
                    'order_id' => $order->id,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'options' => isset($item->options) ? serialize($item->options) : null
                ]);
            }
            if ($request->is_shipping_different == 1) {
                $shipping = Shipping::query()->create([
                    'order_id' => $order->id,
                    'first_name' => $request->s_first_name,
                    'last_name' => $request->s_last_name,
                    'mobile' => $request->s_mobile,
                    'email' => $request->s_email,
                    'line1' => $request->s_line1,
                    'line2' => $request->s_line2 ?? null,
                    'city' => $request->s_city,
                    'province' => $request->s_province,
                    'country' => $request->s_country,
                    'zipcode' => $request->s_zipcode,
                ]);
            }
            if ($request->payment_method == 'cod') {
                Transaction::query()->create([
                    'user_id' => auth()->user()->id,
                    'order_id' => $order->id,
                    'mode' => 'cod',
                    'status' => 'pending'
                ]);
            } elseif ($request->payment_method == 'card') {
                Transaction::query()->create([
                    'user_id' => auth()->user()->id,
                    'order_id' => $order->id,
                    'mode' => 'card',
                    'status' => 'pending'
                ]);
            } elseif ($request->payment_method == 'paypal') {
                Transaction::query()->create([
                    'user_id' => auth()->user()->id,
                    'order_id' => $order->id,
                    'mode' => 'paypal',
                    'status' => 'pending'
                ]);
            }
            DB::commit();

            Cart::instance('cart')->destroy();
            session()->forget('checkout');
            // send confirmation mail
            event(new OrderConfirmation($order));

            return redirect()->route('thankyou');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
