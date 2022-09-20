<?php

namespace App\Http\Livewire\Admin;

use App\Models\Subcategory;
use Livewire\Component;

class GetSubCategories extends Component
{
    public $categories;
    public $category_id;
    public $product;

    public function getSubCategory()
    {
        if ($this->category_id !== null) {
            $sub_categories = Subcategory::query()
                ->where('category_id', $this->category_id)
                ->get();
            if ($sub_categories->count() > 0) {
                return $sub_categories;
            } else {
                return null;
            }
        }
    }

    public function checkSub()
    {
        $count = Subcategory::query()->where('category_id', $this->category_id)->count();
        return $count;
    }

    public function render()
    {

        $checkSub = $this->checkSub();
        $sub_categories = $this->getSubCategory();

        return view('livewire.admin.get-sub-categories', ['sub_categories' => $sub_categories, 'checkSub' => $checkSub]);
    }
}
/*
 * <div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category_id" wire:model="category_id">
            <option value="">Choose One</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}" {{$product->category_id  == $category->id  ? 'selected' : ''}}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    @if($sub_categories !== null || $checkSub > 0)
        <div class="form-group">
            <label>Sub Category</label>
            <select class="form-control" name="subcategory_id">
                @foreach ($sub_categories as $sub_category)
                    <option
                        value="{{ $sub_category->id }}" {{$sub_category->id == $product->subcategory->id ? 'selected' : ''}}>{{ $sub_category->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

*/
