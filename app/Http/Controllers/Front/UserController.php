<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use App\traits\ImageHelper;

class UserController extends Controller
{
    use ImageHelper;

    public function index()
    {
        $user_profile = Profile::query()->where('user_id', auth()->user()->id)->first();
        if (!$user_profile) {
            Profile::query()->create([
                'user_id' => auth()->user()->id
            ]);
        }
        $total_purchase = Order::query()->where('status', '!=', 'canceled')
            ->where('user_id', $user_profile->user_id)
            ->count();
        $total_cost = Order::query()->where('status', '!=', 'canceled')
            ->where('user_id', $user_profile->user_id)
            ->sum('total');
        $total_delivered = Order::query()->where('status', 'delivered')
            ->where('user_id', $user_profile->user_id)
            ->count();
        $total_canceled = Order::query()->where('status', 'canceled')
            ->where('user_id', $user_profile->user_id)
            ->count();

        return view('front.profile.index', compact('user_profile', 'total_purchase',
            'total_cost', 'total_delivered', 'total_canceled'));
    }

    public function edit($id)
    {
        $user_profile = Profile::query()->where('user_id', auth()->user()->id)->firstOrFail();
        return view('front.profile.edit', compact('user_profile'));
    }

    public function update(UpdateProfileRequest $request, $id)
    {
        $validated = $request->safe();
        $user = User::query()->where('id', $id)->firstOrFail();
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);
        $profile = Profile::query()->where('user_id', $id)->firstOrFail();
        // STORE IMAGE
        if ($request->hasFile('image')) {
            if ($profile->image !== null) {
                $this->deleteImage('profiles', $profile->image);
            }
            $image = $this->storeImage('profiles', $validated['image']);
            $profile->image = $image;
        }

        $profile->mobile = $validated['mobile'] ?? null;
        $profile->line1 = $validated['line1'] ?? null;
        $profile->line2 = $validated['line2'] ?? null;
        $profile->city = $validated['city'] ?? null;
        $profile->province = $validated['province'] ?? null;
        $profile->country = $validated['country'] ?? null;
        $profile->zipcode = $validated['zipcode'] ?? null;
        $profile->save();
        return redirect()->route('profile.index');
    }
}
