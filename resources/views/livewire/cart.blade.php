<div>
    @if (Cart::instance('cart')->content()->count() > 0)
        <div class="wrap-iten-in-cart">
            @if (Cart::instance('cart')->count() > 0)
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    @foreach (Cart::instance('cart')->content() as $item)
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="{{ $item->model->image }}" alt="{{ $item->model->name }}">
                                </figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product"
                                   href="{{ route('product.details', $item->model->slug) }}">{{ $item->model->name }}</a>
                            </div>
                            @foreach($item->options as $key=>$value)
                                <div style="vertical-align: middle; width: 100px">
                                    <p><b>{{$key}}: {{$value}}</b></p>
                                </div>
                            @endforeach
                            <div class="price-field produtc-price">
                                <p class="price">${{ $item->model->regular_price }}</p>
                            </div>
                            <div class="quantity">
                                <div class="quantity-input">
                                    <input type="text" name="product-quatity" value="{{ $item->qty }}"
                                           data-max="120" pattern="[0-9]*">
                                    <a class="btn btn-increase"
                                       wire:click.prevent="increaseQuantity('{{ $item->rowId }}')" href="#"></a>
                                    <a class="btn btn-reduce"
                                       wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')" href="#"></a>
                                </div>
                                <p class="text-center"><a href="#"
                                                          wire:click.prevent="saveForLater('{{ $item->rowId }}')">Save
                                        For Later</a></p>
                            </div>
                            <div class="price-field sub-total">
                                <p class="price">${{ $item->subtotal }}</p>
                            </div>
                            <div class="delete">
                                <a href="#" class="btn btn-delete" title=""
                                   wire:click.prevent="destroy('{{ $item->rowId }}')">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Cart is Empty</p>
            @endif
        </div>

        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">Order Summary</h4>
                <p class="summary-info"><span class="title">Subtotal</span><b
                        class="index">${{ Cart::instance('cart')->subtotal() }}</b>
                </p>
                @if (Session::has('coupon'))
                    <p class="summary-info"><span class="title">Discount ({{ Session::get('coupon')['code'] }}) <a
                                href="#" wire:click.prevent="removeCoupon"><i
                                    class="fa fa-times text-danger"></i></a></span><b class="index">
                            -${{ number_format($discount, 2) }}</b>
                    </p>
                    <p class="summary-info"><span class="title">Subtotal After Discount</span><b
                            class="index">${{ number_format($subtotalAfterDiscount, 2) }}</b></p>
                    <p class="summary-info"><span class="title">Tax ({{ config('cart.tax') }}%)</span><b
                            class="index">${{ number_format($taxAfterDiscount, 2) }}</b>
                    </p>
                    <p class="summary-info total-info "><span class="title">Total</span><b
                            class="index">${{ number_format($totalAfterDiscount, 2) }}</b></p>
                @else
                    <p class="summary-info"><span class="title">Tax</span><b
                            class="index">${{ Cart::instance('cart')->tax() }}</b>
                    </p>
                    <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b
                            class="index">${{ Cart::instance('cart')->total() }}</b>
                    </p>
                @endif
            </div>
            <div class="checkout-info">
                <label class="checkbox-field">
                    <input class="frm-input " name="have-code" value="1" id="have-code" type="checkbox"
                           wire:model="haveCouponCode"><span>I
                        have coupon code</span>
                </label>
                @if ($haveCouponCode == 1)
                    <div class="summary-item">
                        <form wire:submit.prevent="applyCouponCode">
                            <h4 class="title-box">Coupon Code</h4>
                            @include('partials._session')
                            <p class="row-in-form">
                                <label for="coupon-code">Enter Your Coupon Code:</label>
                                <input type="text" name="coupon-code" wire:model="couponCode">
                            </p>
                            <button type="submit" class="btn btn-small">Apply</button>
                        </form>
                    </div>
                @endif
                <a class="btn btn-checkout" href="#" wire:click.prevent="checkout">Check out</a>
                <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right"
                                                                             aria-hidden="true"></i></a>
            </div>
            <div class="update-clear">
                <a class="btn btn-clear" href="#" wire:click.prevent="destroyAll">Clear Shopping Cart</a>
                <a class="btn btn-update" href="#">Update Shopping Cart</a>
            </div>
        </div>
    @else
        <div class="text-center" style="padding: 30px 0;">
            <h1>Your Cart is empty!</h1>
            <p>Add items to it now</p>
            <a href="{{ route('shop') }}" class="btn btn-danger">Shop Now</a>
        </div>
    @endif

    <div class="wrap-iten-in-cart">
        <h3 class="title-box" style="border-bottom: 1px solid; padding-bottom: 15px;">
            {{ Cart::instance('saveForLater')->content()->count() }} Saved For Later</h3>
        @if (Cart::instance('saveForLater')->count() > 0)
            <h3 class="box-title">Products Name</h3>
            <ul class="products-cart">
                @foreach (Cart::instance('saveForLater')->content() as $item)
                    <li class="pr-cart-item">
                        <div class="product-image">
                            <figure><img src="{{ $item->model->image }}" alt="{{ $item->model->name }}">
                            </figure>
                        </div>
                        <div class="product-name">
                            <a class="link-to-product"
                               href="{{ route('product.details', $item->model->slug) }}">{{ $item->model->name }}</a>
                        </div>
                        <div class="price-field produtc-price">
                            <p class="price">${{ $item->model->regular_price }}</p>
                        </div>
                        <div class="quantity">
                            <p class="text-center"><a href="#"
                                                      wire:click.prevent="moveToCart('{{ $item->rowId }}')">Move to
                                    Cart</a></p>
                        </div>
                        <div class="delete">
                            <a href="#" class="btn btn-delete" title=""
                               wire:click.prevent="deleteFromSaveForLater('{{ $item->rowId }}')">
                                <span>Delete from Save For Later</span>
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No Items have been Saved</p>
        @endif
    </div>
</div>
