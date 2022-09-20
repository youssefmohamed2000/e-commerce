<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::query()->where('status', 1)->get();
        $latest_products = Product::query()->get()->sortByDesc('created_at')->take(8);
        $category =  HomeCategory::query()->find(1);
        $selected_categories = explode(',', $category->selected);
        $categories = Category::whereIn('id', $selected_categories)->get();
        $no_of_products = $category->no_of_products;
        $sale_products = Product::query()->where('sale_price', '>', 0)->inRandomOrder()->get()->take(8);
        $sale = Sale::query()->find(1);
        if (auth()->check()){
            Cart::instance('cart')->restore(auth()->user()->email);
            Cart::instance('wishlist')->restore(auth()->user()->email);
        }
        return view('front.home', compact('sliders', 'latest_products', 'categories', 'no_of_products', 'sale_products', 'sale'));
    }
}
