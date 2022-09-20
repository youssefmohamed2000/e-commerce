<div class="wrap-search center-section">
    <div class="wrap-search-form">
        <form id="form-search-top" name="form-search-top">
            <input type="text" name="search" id="search" value="" placeholder="Search here..."
                wire:model="search">
            <button form="form-search-top" type="submit" wire:click.prevent="jss"><i class="fa fa-search"
                    aria-hidden="true"></i></button>
            <div class="wrap-list-cate">
                {{-- <input type="hidden" name="category"  id="product-cate"> --}}
                <a href="#" class="link-control">{{ $category_name }}</a>
                <select name="category" class="list-cate">
                    <option class="level-0" value="{{ $category_name }}">All Categories</option>
                    @foreach ($categories as $category)
                        <option class="level-1" value="{{ $category->name }}" wire:model="category">
                            -{{ $category->name }}
                        </option>
                    @endforeach
                </select>
                {{-- <ul class="list-cate">
                    <li class="level-0">All Categories</li>
                    @foreach ($categories as $category)
                        <li class="level-1" wire:model="category">-{{ $category->name }}</li>
                    @endforeach
                </ul> --}}
            </div>
        </form>
    </div>
</div>
