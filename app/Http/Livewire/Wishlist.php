<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class Wishlist extends Component
{
    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count', 'refreshComponent');
            }
        }
    }

    public function moveToCart($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        $this->emitTo('cart-count', 'refreshComponent');
        $this->emitTo('wishlist-count', 'refreshComponent');
    }

    public function render()
    {
        if (auth()->check()){
            Cart::instance('wishlist')->store(auth()->user()->email);
        }
        return view('livewire.wishlist');
    }
}
