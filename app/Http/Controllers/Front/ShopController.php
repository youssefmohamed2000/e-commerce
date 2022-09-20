<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $popular_products = Product::query()->inRandomOrder()->limit(8)->get();
        return view('front.shop' , compact('popular_products'));
    }
}
