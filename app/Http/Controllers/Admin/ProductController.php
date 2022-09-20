<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductAttribute;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\traits\ImageHelper;

class ProductController extends Controller
{
    use ImageHelper;

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->safe();
        $name = $validated['name'];
        $slug = Str::slug($name);
        // Store Image
        $image = $this->storeImage('products', $validated['image']);

        // Store Images
        if ($request->hasFile('images')) {
            $images_name = $this->storeMultipleImage('products', $request->file('images'));
        }

        Product::query()->create([
            'name' => $name,
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'regular_price' => $validated['regular_price'],
            'sale_price' => $validated['sale_price'],
            'SKU' => $validated['SKU'],
            'stock_status' => $validated['stock_status'],
            'featured' => $validated['featured'],
            'quantity' => $validated['quantity'],
            'image' => $image,
            'images' => $images_name ?? null,
        ]);
        session()->flash('success', 'Added Successfully');
        return redirect()->route('admin.products.index');
    }

    public function edit($slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $attributes = ProductAttribute::all();
        return view('admin.product.edit', compact('product', 'categories', 'attributes'));
    }

    public function update(UpdateProductRequest $request, $slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $validated = $request->safe();
        $name = $validated['name'];
        $slug = Str::slug($name);
        // Update Image
        if ($request->hasFile('image')) {
            $this->deleteImage('products', $product->image);
            $image = $this->storeImage('products', $validated['image']);
            $product->image = $image;
            $product->save();
        }

        // Update Images
        if ($request->hasFile('images')) {
            $images = explode(',', $product->images);
            foreach ($images as $img) {
                if ($img) {
                    $img_path = base_path('public\assets\images\products' . '\\' . $img);
                    unlink($img_path);
                }
            }
            $images_name = $this->storeMultipleImage('products', $request->file('images'));
            $product->images = $images_name;
            $product->save();
        }

        $product->update([
            'name' => $name,
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'] ?? null,
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'regular_price' => $validated['regular_price'],
            'sale_price' => $validated['sale_price'],
            'SKU' => $validated['SKU'],
            'stock_status' => $validated['stock_status'],
            'featured' => $validated['featured'],
            'quantity' => $validated['quantity'],
        ]);
        session()->flash('success', 'Updated Successfully');
        return redirect()->route('admin.products.index');
    }

    public function destroy($slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        // DELETE IMAGE
        $this->deleteImage('products', $product->image);

        // DELETE IMAGES
        if ($product->images) {
            $images = explode(',', $product->images);
            foreach ($images as $img) {
                if ($img) {
                    $img_path = base_path('public\assets\images\products' . '\\' . $img);
                    unlink($img_path);
                }
            }
        }

        $product->delete();
        session()->flash('success', 'Deleted Successfully');
        return redirect()->route('admin.products.index');
    }

    public function attributes($slug)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        $attributes = ProductAttribute::all();
        return view('admin.product.attribute', compact('product', 'attributes'));
    }
}
