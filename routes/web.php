<?php

use App\Events\OrderConfirmation;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\ReviewController;


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('/profile', UserController::class)->only('index', 'edit', 'update')->middleware('auth');

    Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::view('/thank-you', 'front.thankyou')->name('thankyou');

    Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

    Route::resource('/orders', OrderController::class)->only(['index', 'show', 'update']);

    Route::get('review/{order_item_id}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('review/{order_item_id}', [ReviewController::class, 'store'])->name('review.store');
});

// SHOP PAGE
Route::get('/shop/{search?}', [ShopController::class, 'index'])->name('shop');

// CART PAGE
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// WISHLIST PAGE
Route::view('/wishlist', 'front.wishlist')->name('wishlist');

// PRODUCT DETAILS PAGE
Route::get('/product/{slug}', [ProductController::class, 'details'])->name('product.details');
