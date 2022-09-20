<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class Shop extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $popular_products;
    public $sorting;
    public $pageSize;
    public $category;
    public $sub_category_id;
    public $price;

    public function mount()
    {
        $this->sorting = 'default';
        $this->pageSize = 12;
        $this->category = 'All Categories';
        $this->sub_category_id = null;
        $this->price = 'all';
    }


    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate(Product::class);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate(Product::class);
        $this->emitTo('wishlist-count', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count', 'refreshComponent');
            }
        }
    }

    public function categoryId($category_name, $sub_category_id = null)
    {
        if ($category_name == 'all') {
            $this->category = 'All Categories';
        }
        $this->category = DB::table('categories')->where('name', $category_name)->value('id');
        $this->sub_category_id = $sub_category_id;
    }

    public function priceFilter($query)
    {
        if ($this->price == 50) {
            $query->where('regular_price', '<=', 50);
        } elseif ($this->price == 100) {
            $query->where('regular_price', '<=', 100)
                ->where('regular_price', '>=', 50);
        } elseif ($this->price == 150) {
            $query->where('regular_price', '<=', 150)
                ->where('regular_price', '>=', 100);
        } elseif ($this->price == 200) {
            $query->where('regular_price', '<=', 150)
                ->where('regular_price', '>=', 200);
        } elseif ($this->price == 201) {
            $query->where('regular_price', '>', 200);
        }
    }

    public function render()
    {
        if ($this->category !== null && $this->category !== 'All Categories') {
            $category_name = Category::query()->where('id', $this->category)->value('name');
            if ($this->sorting == 'newest') {
                $products = Product::query()
                    ->where('category_id', $this->category)
                    ->where(function ($query) {
                        if ($this->sub_category_id !== null) {
                            $query->where('subcategory_id', $this->sub_category_id);
                        }
                    })->where(function ($query) {
                        $this->priceFilter($query);
                    })->orderBy('created_at', 'DESC')
                    ->paginate($this->pageSize);
            } elseif ($this->sorting == 'price') {
                $products = Product::query()
                    ->where('category_id', $this->category)
                    ->where(function ($query) {
                        if ($this->sub_category_id !== null) {
                            $query->where('subcategory_id', $this->sub_category_id);
                        }
                    })->where(function ($query) {
                        $this->priceFilter($query);
                    })->orderBy('regular_price', 'ASC')
                    ->paginate($this->pageSize);
            } elseif ($this->sorting == 'price-desc') {
                $products = Product::query()
                    ->where('category_id', $this->category)
                    ->where(function ($query) {
                        if ($this->sub_category_id !== null) {
                            $query->where('subcategory_id', $this->sub_category_id);
                        }
                    })->where(function ($query) {
                        $this->priceFilter($query);
                    })->orderBy('regular_price', 'DESC')
                    ->paginate($this->pageSize);
            } else {
                $products = Product::query()
                    ->where('category_id', $this->category)
                    ->where(function ($query) {
                        if ($this->sub_category_id !== null) {
                            $query->where('subcategory_id', $this->sub_category_id);
                        }
                    })->where(function ($query) {
                        $this->priceFilter($query);
                    })->paginate($this->pageSize);
            }
        } else {
            $category_name = 'All Categories';
            if ($this->sorting == 'newest') {
                $products = Product::query()
                    ->where(function ($query) {
                        $this->priceFilter($query);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate($this->pageSize);
            } elseif ($this->sorting == 'price') {
                $products = Product::query()
                    ->where(function ($query) {
                        $this->priceFilter($query);
                    })
                    ->orderBy('regular_price', 'ASC')
                    ->paginate($this->pageSize);
            } elseif ($this->sorting == 'price-desc') {
                $products = Product::query()
                    ->where(function ($query) {
                        $this->priceFilter($query);
                    })
                    ->orderBy('regular_price', 'DESC')
                    ->paginate($this->pageSize);
            } else {
                $products = Product::query()
                    ->where(function ($query) {
                        $this->priceFilter($query);
                    })
                    ->paginate($this->pageSize);
            }

        }
        if (auth()->check()) {
            Cart::instance('cart')->store(auth()->user()->email);
            Cart::instance('wishlist')->store(auth()->user()->email);
        }

        return view('livewire.shop', ['products' => $products, 'category_name' => $category_name]);
    }
}
