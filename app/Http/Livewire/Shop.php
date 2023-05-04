<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class Shop extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    public Collection $popular_products;
    public string $sorting;
    public int $pageSize;
    public int $category_id;
    public int $sub_category_id;
    public int $price_range;
    public string $search;

    public function mount()
    {
        $this->sorting = '';
        $this->pageSize = 12;
        $this->category_id = 0;
        $this->sub_category_id = 0;
        $this->price_range = 0;

        if (request()->has('search')) {
            $this->search = request()->search;
        } else {
            $this->search = '';
        }
    }


    public function filter(): array
    {
        return [
            'category_id' => $this->category_id,
            'name' => $this->search,
        ];
    } // end of filter


    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')
            ->add($product_id, $product_name, 1, $product_price)
            ->associate(Product::class);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')
            ->add($product_id, $product_name, 1, $product_price)
            ->associate(Product::class);
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

    public function getCategoryId($id)
    {
        $this->category_id = (int) $id;
    } // end of getCategoryId

    public function getSubCategoryId($id)
    {
        $this->sub_category_id = (int) $id;
    } // end of getCategoryId

    public function getPriceRange($products)
    {
        return match ($this->price_range) {
            50 => $products->where('regular_price', '<=', 50),

            100 => $products->where('regular_price', '<=', 100)
                ->where('regular_price', '>=', 50),

            150 => $products->where('regular_price', '<=', 150)
                ->where('regular_price', '>=', 100),

            200 => $products->where('regular_price', '<=', 150)
                ->where('regular_price', '>=', 200),

            201 => $products->where('regular_price', '>', 200),
            default => $products->inRandomOrder(),
        };
    } // end of getCategoryId

    public function sortBy($products)
    {
        return match ($this->sorting) {
            'newest' => $products->orderByDesc('created_at'),
            'price' => $products->orderBy('regular_price'),
            'price-desc' => $products->orderByDesc('regular_price'),
            default => $products->inRandomOrder(),
        };
    } // end of sortBy

    public function result()
    {
        $products = Product::query()
            ->filter($this->filter());

        return $this->sortBy($this->getPriceRange($products))
            ->paginate($this->pageSize);
    } // end of result


    public function render(): View
    {
        if (auth()->check()) {
            Cart::instance('cart')->store(auth()->user()->email);
            Cart::instance('wishlist')->store(auth()->user()->email);
        }

        return view('livewire.shop',
            /*['products' => $products, 'category_name' => $category_name]*/
            [
                'products' => $this->result(),
            ]);
    }
}
