<div class="row">
    @if (Cart::instance('wishlist')->content()->count() > 0)
        <ul class="product-list grid-products equal-container">
            @foreach (Cart::instance('wishlist')->content() as $item)
                <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ">
                    <div class="product product-style-3 equal-elem ">
                        <div class="product-thumnail">
                            <a href="{{ route('product.details', $item->model->slug) }}"
                                title="{{ $item->model->short_description }}">
                                <figure><img src="{{ $item->model->image }}" alt="{{ $item->model->name }}"></figure>
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.details', $item->model->slug) }}"
                                class="product-name"><span>{{ $item->model->name }}</span></a>
                            <div class="wrap-price"><span class="product-price">{{ $item->model->regular_price }}</span>
                            </div>
                            <a href="#" class="btn add-to-cart"
                                wire:click.prevent="moveToCart('{{ $item->rowId }}')">Move
                                To Cart</a>
                            <div class="product-wish">
                                <a href="#" wire:click.prevent="removeFromWishlist({{ $item->model->id }})"><i
                                        class="fa fa-heart fill-heart"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <h4>No Items In Wishlist</h4>

    @endif

</div>
