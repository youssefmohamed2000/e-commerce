<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $most_viewed = Product::query()->inRandomOrder()->limit(8)->get();
        return view('front.cart' , compact('most_viewed'));
    }
}
