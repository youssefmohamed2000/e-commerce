<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\traits\ImageHelper;

class SliderController extends Controller
{
    use ImageHelper;

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $validated = $request->safe();
        $title = $validated['title'];
        $slug = Str::slug($title);

        // STORE IMAGE
        $image = $this->storeImage('sliders', $validated['image']);

        Slider::query()->create([
            'title' => $title,
            'slug' => $slug,
            'image' => $image,
            'status' => $validated['status'],
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function edit($slug)
    {
        $slider = Slider::query()->where('slug', $slug)->firstOrFail();
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, $slug)
    {
        $slider = Slider::query()->where('slug', $slug)->firstOrFail();
        $validated = $request->safe();
        $title = $validated['title'];
        $slug = Str::slug($title);
        // UPDATE IMAGE
        if ($request->hasFile('image')) {
            $this->deleteImage('sliders', $slider->image);
            $image = $this->storeImage('sliders', $validated['image']);
            $slider->image = $image;
            $slider->save();
        }

        $slider->update([
            'title' => $title,
            'slug' => $slug,
            'status' => $validated['status'],
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.sliders.index');
    }

    public function destroy($slug)
    {
        $slider = Slider::query()->where('slug', $slug)->firstOrFail();
        // DELETE IMAGE
        $this->deleteImage('sliders', $slider->image);

        $slider->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('admin.sliders.index');
    }
}
