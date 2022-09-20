<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function increaseQuantity($rowId)
    {
        $product = FacadesCart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        FacadesCart::update($rowId, $qty);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = FacadesCart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        FacadesCart::update($rowId, $qty);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function destroy($rowId)
    {
        FacadesCart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function destroyAll()
    {
        FacadesCart::instance('cart')->destroy();
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function saveForLater($rowId)
    {
        $item = FacadesCart::instance('cart')->get($rowId);
        FacadesCart::instance('cart')->remove($rowId);
        FacadesCart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function deleteFromSaveForLater($rowId)
    {
        FacadesCart::instance('saveForLater')->remove($rowId);
    }

    public function moveToCart($rowId)
    {
        $item = FacadesCart::instance('saveForLater')->get($rowId);
        FacadesCart::instance('saveForLater')->remove($rowId);
        FacadesCart::instance('cart')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);
        $this->emitTo('cart-count', 'refreshComponent');
    }

    public function applyCouponCode()
    {
        $coupon = Coupon::query()->where('code', $this->couponCode)
            ->where('cart_value', '<=', FacadesCart::instance('cart')->subtotal())
            ->where('expiry_date', '>=', Carbon::today())
            ->first();
        if (!$coupon) {
            session()->flash('error', 'Coupon Code is invalid');
            return;
        }
        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value,
        ]);
    }

    public function calculateDiscounts()
    {
        if (session()->has('coupon')) {
            if (session()->get('coupon')['type'] == 'fixed') {
                $this->discount = session()->get('coupon')['value'];
            } else {
                $this->discount = (FacadesCart::instance('cart')->subtotal() * session()->get('coupon')['value']) / 100;
            }
            $this->subtotalAfterDiscount = (FacadesCart::instance('cart')->subtotal() - $this->discount);
            $this->taxAfterDiscount = ($this->subtotalAfterDiscount * config('cart.tax')) / 100;
            $this->totalAfterDiscount = $this->subtotalAfterDiscount + $this->taxAfterDiscount;
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function checkout()
    {
        if (auth()->check()) {
            return redirect()->route('checkout');
        } else {
            return redirect()->route('login');
        }
    }

    public function setAmountForCheckout()
    {
        if (FacadesCart::instance('cart')->content()->count() == 0) {
            session()->forget('checkout');
        }
        if (session()->has('coupon')) {
            session()->put('checkout', [
                'discount' => $this->discount,
                'subtotal' => $this->subtotalAfterDiscount,
                'tax'      => $this->taxAfterDiscount,
                'total'    => $this->totalAfterDiscount
            ]);
        } else {
            session()->put('checkout', [
                'discount' => 0,
                'subtotal' => FacadesCart::instance('cart')->subtotal(),
                'tax'      => FacadesCart::instance('cart')->tax(),
                'total'    => FacadesCart::instance('cart')->total()
            ]);
        }
    }

    public function render()
    {
        if (session()->has('coupon')) {
            if (FacadesCart::instance('cart')->subtotal() < session()->get('coupon')['cart_value']) {
                session()->forget('coupon');
            } else {
                $this->calculateDiscounts();
            }
        }
        $this->setAmountForCheckout();
        if (auth()->check()){
            FacadesCart::instance('cart')->store(auth()->user()->email);
        }
        return view('livewire.cart');
    }
}

