<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\HomeCategory;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $name = $request->safe()->name;
        $slug = Str::slug($name);
        if ($request->category_id !== null) {
            Subcategory::query()->create([
                'name' => $name,
                'slug' => $slug,
                'category_id' => $request->category_id
            ]);
        } else {
            Category::query()->create([
                'name' => $name,
                'slug' => $slug
            ]);
        }
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.categories.index');
    }

    public function edit($slug)
    {
        $categories = Category::all();
        if (\request()->sub_slug !== null) {
            $sub_category = Subcategory::query()->where('slug', \request()->query('sub_slug'))->firstOrFail();
            return view('admin.category.edit', compact('sub_category', 'categories'));
        } else {
            $category = Category::query()->where('slug', $slug)->firstOrFail();
            return view('admin.category.edit', compact('category', 'categories'));
        }
    }

    public function update(UpdateCategoryRequest $request, $slug)
    {
        $name = $request->safe()->name;
        if ($request->sub_slug !== null) {
            $category = Subcategory::query()->where('slug', $request->sub_slug)->firstOrFail();
            $category->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $request->parent_category_id
            ]);
        } else {
            $category = Category::query()->where('slug', $slug)->firstOrFail();
            $category->update([
                'name' => $name,
                'slug' => Str::slug($name)
            ]);
        }
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.categories.index');
    }

    public function destroy($slug)
    {
        if (\request()->sub_slug !== null) {
            Subcategory::query()->where('slug', \request()->sub_slug)->firstOrFail()->delete();
        } else {
            Category::query()->where('slug', $slug)->firstOrFail()->delete();
        }
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('admin.categories.index');
    }

    public function manage()
    {
        $categories = Category::with('products')->get();
        return view('admin.category.manage', compact('categories'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'categories' => 'required',
            'no_of_products' => 'required',
        ]);
        $home_categories = HomeCategory::query()->find(1);
        $home_categories->update([
            'selected' => implode(',', $request->categories),
            'no_of_products' => $request->no_of_products
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.categories.index');
    }

}
