<div>
    <div class="form-group">
        <label>Category</label>
        <select class="form-control" name="category_id" wire:model="category_id">
            <option selected value="">Choose One</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}" {{$product !== null && $product->category_id  == $category->id  ? 'selected' : ''}}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    @if($sub_categories !== null || $checkSub > 0)
        <div class="form-group">
            <label>Sub Category</label>
            <select class="form-control" name="subcategory_id">
                <option value="">Choose One</option>
                @foreach ($sub_categories as $sub_category)
                    <option
                        value="{{ $sub_category->id }}" {{$product !== null && $sub_category->id == $product->subcategory_id ? 'selected' : ''}}>{{ $sub_category->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

