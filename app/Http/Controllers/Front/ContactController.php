<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $user = User::query()->findOrFail(auth()->user()->id);
        $setting = Setting::query()->first();
        return view('front.contact', compact('setting', 'user'));
    }

    public function store(StoreContactRequest $request)
    {
        $validated = $request->safe();
        Contact::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'comment' => $validated['comment']
        ]);

        session()->flash('success', 'Message sent successfully');
        return redirect()->route('contact');
    }
}
