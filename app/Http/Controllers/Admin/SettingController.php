<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::query()->first();
        return view('admin.setting.index', compact('setting'));
    }

    public function create()
    {
        $setting = Setting::query()->first();
        if (!$setting) {
            return view('admin.setting.create');
        } else {
            session()->flash('error', 'You Cannot add new settings but you can update the existing one');
            return redirect()->route('admin.settings.index');
        }
    }

    public function store(SettingRequest $request)
    {
        $validated = $request->safe();
        Setting::query()->create([
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'phone2' => $validated['phone2'],
            'address' => $validated['address'],
            'map' => $validated['map'],
            'twitter' => $validated['twitter'],
            'facebook' => $validated['facebook'],
            'pinterest' => $validated['pinterest'],
            'instagram' => $validated['instagram'],
            'youtube' => $validated['youtube'],
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.settings.index');
    }


    public function edit($id)
    {
        $setting = Setting::query()->find($id);
        if (!$setting) {
            return redirect()->route('admin.settings.create');
        }
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(SettingRequest $request, $id)
    {
        $setting = Setting::query()->findOrFail($id);
        $validated = $request->safe();
        $setting->update([
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'phone2' => $validated['phone2'],
            'address' => $validated['address'],
            'map' => $validated['map'],
            'twitter' => $validated['twitter'],
            'facebook' => $validated['facebook'],
            'pinterest' => $validated['pinterest'],
            'instagram' => $validated['instagram'],
            'youtube' => $validated['youtube'],
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.settings.index');
    }

}
