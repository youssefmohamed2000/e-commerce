<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductDetails extends Component
{

    public $product;
    public $qty;
    public $sale;
    public $attributes = array();

    public function mount()
    {
        $this->qty = 1;
        $this->sale = Sale::query()->find(1);
    }

    public function increaseQuantity()
    {
        $this->qty++;
    }

    public function decreaseQuantity()
    {
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, $this->qty, $product_price, $this->attributes)->associate(Product::class);
        session()->flash('success', 'Item Added Successfully');
        return redirect()->route('cart');
    }

    public function render()
    {
        return view('livewire.product-details');
    }
}
