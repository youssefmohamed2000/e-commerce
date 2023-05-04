<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;


// LOGIN ROUTES
Route::get('/login', [AuthController::class, 'index'])->name('loginForm');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:admin'], function () {
    // LOGOUT ROUTE
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // ADMIN HOME PAGE
    Route::get('/', [HomeController::class, 'index'])->name('home');

    /* CATEGORIES ROUTES */
    // MANAGE HOME PAGE CATEGORY
    Route::get('/categories/manage', [CategoryController::class, 'manage'])->name('categories.manage');
    Route::post('/categories/manage', [CategoryController::class, 'save'])->name('categories.manage.save');

    // UPDATE SUBCATEGORIES
    Route::get('/categories/{slug}/edit/{sub_slug?}', [CategoryController::class, 'edit']);
    Route::post('/categories/{slug}/{sub_slug?}', [CategoryController::class, 'update']);
    Route::delete('/categories/{slug}/{sub_slug?}', [CategoryController::class, 'destroy']);

    // CATEGORIES ROUTES
    Route::resource('/categories', CategoryController::class)->except('show')->parameters([
        'categories' => 'slug'
    ]);

    // PRODUCTS Attributes ROUTES
    Route::get('products/{product_slug}/attributes', [ProductController::class, 'showAttributes'])
        ->name('products.attributes.index');
    Route::get('products/{product_slug}/attributes/create', [ProductController::class, 'createAttributes'])
        ->name('products.attributes.create');
    Route::post('products/{product_slug}/attributes', [ProductController::class, 'storeAttributes'])
        ->name('products.attributes.store');
    Route::get('products/{product_slug}/attributes/{id}/edit', [ProductController::class, 'editAttributes'])
        ->name('products.attributes.edit');
    Route::put('products/{product_slug}/attributes/{id}', [ProductController::class, 'updateAttributes'])
        ->name('products.attributes.update');
    Route::delete('products/{product_slug}/attributes/{id}', [ProductController::class, 'destroyAttributes'])
        ->name('products.attributes.destroy');

    // PRODUCTS ROUTES
    Route::resource('/products', ProductController::class)->except('show')->parameters([
        'products' => 'slug'
    ]);

    // ATTRIBUTES ROUTES
    Route::resource('attributes', ProductAttributeController::class)->except('show')->parameters([
        'attributes' => 'slug'
    ]);

    // SLIDERS ROUTES
    Route::resource('/sliders', SliderController::class)->except('show')->parameters([
        'sliders' => 'slug'
    ]);

    // SALES ROUTES
    Route::resource('/sales', SaleController::class)->only(['index', 'edit', 'update']);

    // COUPONS ROUTES
    Route::resource('/coupons', CouponController::class)->except('show')->parameters([
        'coupons' => 'slug'
    ]);

    // ORDERS ROUTES
    // Route::post('/orders/{id}/status', [OrderController::class, 'status'])->name('orders.status');
    Route::resource('/orders', OrderController::class)->only(['index', 'show', 'update']);

    // CONTACT ROUTE
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');

    // SETTINGS ROUTES
    Route::resource('/settings', SettingController::class)->except(['show', 'destroy']);
});

