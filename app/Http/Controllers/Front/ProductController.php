<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;

class ProductController extends Controller
{
    public function details($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(8)->get();
        $sale = Sale::query()->find(1);
        //dd($sale->status);
        return view('front.product_details', compact('product', 'popular_products', 'related_products' , 'sale'));
    }
}
