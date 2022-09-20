<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    public function index()
    {
        $attributes = ProductAttribute::all();
        return view('admin.attribute.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.attribute.create');
    }

    public function store(StoreAttributeRequest $request)
    {
        $validated = $request->safe();
        $slug = Str::slug($validated['name']);
        ProductAttribute::query()->create([
            'name' => $validated['name'],
            'slug' => $slug
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.attributes.index');
    }

    public function edit($slug)
    {
        $attribute = ProductAttribute::query()->where('slug', $slug)->firstOrFail();
        return view('admin.attribute.edit', compact('attribute'));
    }

    public function update(UpdateAttributeRequest $request, $slug)
    {
        $attribute = ProductAttribute::query()->where('slug', $slug)->firstOrFail();
        $validated = $request->safe();
        $slug = Str::slug($validated['name']);
        $attribute->update([
            'name' => $validated['name'],
            'slug' => $slug
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.attributes.index');
    }

    public function destroy($slug)
    {
        $attribute = ProductAttribute::query()->where('slug', $slug)->firstOrFail()->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('admin.attributes.index');
    }
}
