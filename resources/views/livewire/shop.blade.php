<div class="row">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
        <div class="banner-shop">
            <a href="#" class="banner-link">
                <figure><img src="{{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
            </a>
        </div>
        <div class="wrap-shop-control">
            <h1 class="shop-title">Shop Products</h1>
            <div class="wrap-right">
                <div class="sort-item orderby">
                    <select name="sorting" class="use-chosen" wire:model="sorting">
                        <option value="default">Default sorting</option>
                        <option value="newest">Sort by newest</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div>

                <div class="sort-item orderby">
                    <select name="price_range" class="use-chosen" wire:model="price_range">
                        <option value="0" selected>All Prices</option>
                        <option value="50">$0.00 - $50.00</option>
                        <option value="100">$50.00 - $100.00</option>
                        <option value="150">$100.00 - $150.00</option>
                        <option value="200">$150.00 - $200.00</option>
                        <option value="201">$200.00+</option>
                    </select>
                </div>

                <div class="sort-item product-per-page">
                    <select class="use-chosen" wire:model="pageSize">
                        <option value="12" selected>12 per page</option>
                        <option value="16">16 per page</option>
                        <option value="18">18 per page</option>
                        <option value="21">21 per page</option>
                        <option value="24">24 per page</option>
                        <option value="30">30 per page</option>
                        <option value="32">32 per page</option>
                    </select>
                </div>

            </div>
        </div>
        <!--end wrap shop control-->

        <style>
            .product-wish {
                position: absolute;
                top: 10%;
                left: 0;
                z-index: 99;
                right: 30px;
                text-align: right;
                padding-top: 0;
            }

            .product-wish .fa {
                color: #cbcbcb;
                font-size: 32px;
            }

            .product-wish .fa:hover {
                color: #ff7007;
            }

            .fill-heart {
                color: #ff7007 !important;
            }
        </style>
        <div class="row">
            <ul class="product-list grid-products equal-container">
                @php
                    $witems = Cart::instance('wishlist')
                        ->content()
                        ->pluck('id');
                @endphp
                @forelse ($products as $product)
                    <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                        <div class="product product-style-3 equal-elem ">
                            <div class="product-thumnail">
                                <a href="{{ route('product.details', $product->slug) }}"
                                   title="{{ $product->short_description }}">
                                    <figure><img src="{{ $product->image }}" alt="{{ $product->name }}"></figure>
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="{{ route('product.details', $product->slug) }}"
                                   class="product-name"><span>{{ $product->name }}</span></a>
                                <div class="wrap-price"><span
                                        class="product-price">${{ $product->regular_price }}</span>
                                </div>
                                <a href="#" class="btn add-to-cart"
                                   wire:click.prevent="store({{ $product->id }} ,'{{ $product->name }}' , {{ $product->regular_price }})">Add
                                    To Cart</a>
                                <div class="product-wish">
                                    @if ($witems->contains($product->id))
                                        <a href="#"
                                           wire:click.prevent="removeFromWishlist({{ $product->id }})"><i
                                                class="fa fa-heart fill-heart"></i></a>
                                    @else
                                        <a href="#"
                                           wire:click.prevent="addToWishlist({{ $product->id }} ,'{{ $product->name }}' , {{ $product->regular_price }})"><i
                                                class="fa fa-heart"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                        <div class="product product-style-3 equal-elem ">
                            <b>There are no Products like you want</b>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
        <div class="wrap-pagination-info">
            {{ $products->links() }}
        </div>

    </div>
    <!--end main products area-->

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
        <div class="widget mercado-widget categories-widget">
            <div class="widget-content">
                <ul class="list-category">
                    <li class="widget-title">
                        <a href="#" class="filter-link" wire:click.prevent="categoryId('all')">All Categories</a>
                    </li>
                    @foreach (App\Models\Category::all() as $category)
                        <li class="category-item {{count($category->subCategories) > 0 ? 'has-child-cate' : ''}}">
                            {{--<a href="#" class="filter-link"
                               wire:click.prevent="categoryId('{{ $category->name }}')">{{ $category->name }}</a>--}}
                            <a href="#" class="filter-link"
                               wire:click.prevent="getCategoryId('{{ $category->id }}')">{{ $category->name }}</a>
                            @if(count($category->subCategories) > 0)
                                <span class="toggle-control">+</span>
                                <ul class="sub-cate">
                                    @foreach($category->subCategories as $sub)
                                        <li class="category-item">
                                            {{--<a href="#" class="cat-link"
                                               wire:click.prevent="categoryId('{{ $category->name }}' , {{$sub->id}})"><i
                                                    class="fa fa-caret-right"></i> {{$sub->name}}</a>--}}
                                            <a href="#" class="cat-link"
                                               wire:click.prevent="getSubCategoryId('{{$sub->id}})"><i
                                                    class="fa fa-caret-right"></i> {{$sub->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- Categories widget-->

        <div class="widget mercado-widget widget-product">
            <h2 class="widget-title">Popular Products</h2>
            <div class="widget-content">
                <ul class="products">
                    @foreach($popular_products as $product)
                        <li class="product-item">
                            <div class="product product-widget-style">
                                <div class="thumbnnail">
                                    <a title="{{$product->name}}">
                                        <figure><img src="{{ $product->image }}"
                                                     alt="{{$product->name}}">
                                        </figure>
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="{{route('product.details' , $product->slug)}}"
                                       class="product-name"><span>{{$product->name}}</span></a>
                                    <div class="wrap-price"><span
                                            class="product-price">${{$product->regular_price}}</span></div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div><!-- brand widget-->
    </div>
    <!--end sitebar-->
</div>
<!--end row-->
