<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(StoreCouponRequest $request)
    {
        $validated = $request->safe();
        $slug = Str::slug($validated['code']);
        Coupon::query()->create([
            'code' => $validated['code'],
            'slug' => $slug,
            'type' => $validated['type'],
            'value' => $validated['value'],
            'cart_value' => $validated['cart_value'],
            'expiry_date' => $validated['expiry_date']
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.coupons.index');
    }

    public function edit($slug)
    {
        $coupon = Coupon::query()->where('slug', $slug)->firstOrFail();
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, $slug)
    {
        $coupon = Coupon::query()->where('slug', $slug)->firstOrFail();
        $validated = $request->safe();
        $slug = Str::slug($validated['code']);
        $coupon->update([
            'code' => $validated['code'],
            'slug' => $slug,
            'type' => $validated['type'],
            'value' => $validated['value'],
            'cart_value' => $validated['cart_value'],
            'expiry_date' => $validated['expiry_date']
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.coupons.index');
    }

    public function destroy($slug)
    {
        Coupon::query()->where('slug', $slug)->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('admin.coupons.index');
    }
}
