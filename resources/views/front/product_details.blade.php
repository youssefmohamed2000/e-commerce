@extends('front.layouts.index')
@section('title')
    <title>Details</title>
@endsection
@section('livewire-style')
    @livewireStyles
@endsection

@section('content')
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                    <li class="item-link"><a href="{{ route('shop') }}" class="link">Shop</a></li>
                    <li class="item-link"><span>Details</span></li>
                </ul>
            </div>
            <div class="row">

                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                    <div class="wrap-product-detail">
                        <div class="detail-media">
                            <div class="product-gallery">
                                <ul class="slides">
                                    <li data-thumb="{{ $product->image }}">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}"/>
                                    </li>
                                    @php
                                        $images = explode(',' , $product->images);
                                    @endphp
                                    @foreach($images as $image)
                                        @if($image)
                                            <li data-thumb="{{ asset('assets/images/products/'.$image) }}">
                                                <img src="{{ asset('assets/images/products/'.$image) }}"
                                                     alt="{{ $product->name }}"/>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="detail-info">
                            <div class="product-rating">
                                <style>
                                    .color-grey {
                                        color: #e6e6e6 !important
                                    }
                                </style>
                                @php
                                    $avg_rating = 0;
                                @endphp
                                @foreach ($product->orderItems->where('review_status', 1) as $item)
                                    @php
                                        $avg_rating += $item->review->rating;
                                    @endphp
                                @endforeach
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $avg_rating)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star color-grey" aria-hidden="true"></i>
                                    @endif
                                @endfor
                                <a href="#"
                                   class="count-review">({{ $product->orderItems->where('review_status', 1)->count() }}
                                    review)</a>
                            </div>
                            <h2 class="product-name">{{ $product->name }}</h2>
                            <div class="short-desc">
                                {{ $product->short_description }}
                            </div>
                            <div class="wrap-social">
                                <a class="link-socail" href="#"><img
                                        src="{{ asset('assets/images/social-list.png') }}" alt=""></a>
                            </div>
                            <div class="wrap-price">
                                @if ($product->sale_price !== null && $sale->status == 1 && $sale->sale_date > \Carbon\Carbon::now())
                                    <ins>
                                        <p class="product-price">${{ $product->sale_price }}</p>
                                    </ins>
                                    <del>
                                        <p class="product-price">${{ $product->regular_price }}</p>
                                    </del>
                                @else
                                    <ins>
                                        <p class="product-price">${{ $product->regular_price }}</p>
                                    </ins>
                                @endif
                            </div>
                            <div class="stock-info in-stock">
                                <p class="availability">Availability: <b>{{ $product->stock_status }}</b></p>
                            </div>
                            @livewire('product-details', ['product' => $product], key($product->id))
                        </div>
                        <div class="advance-info">
                            <div class="tab-control normal">
                                <a href="#description" class="tab-control-item active">description</a>
                                <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                                <a href="#review" class="tab-control-item">Reviews</a>
                            </div>
                            <div class="tab-contents">
                                <div class="tab-content-item active" id="description">
                                    <p>{{ $product->description }}</p>
                                </div>
                                <div class="tab-content-item " id="add_infomation">
                                    <table class="shop_attributes">
                                        <tbody>
                                        @forelse($product->attributeValues as $value)
                                            <tr>
                                                <th>{{$value->productAttributes->name}}</th>
                                                <td class="product_weight">{{$value->value}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                No Information about this Product
                                            </tr>
                                        @endforelse
                                        {{--<tr>
                                            <th>Dimensions</th>
                                            <td class="product_dimensions">12 x 15 x 23 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Grey, Violet, Yellow</p>
                                            </td>
                                        </tr>--}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-content-item " id="review">
                                    <div class="wrap-review-form">
                                        <style>
                                            .width-0-percent {
                                                width: 0%;
                                            }

                                            .width-20-percent {
                                                width: 20%;
                                            }

                                            .width-40-percent {
                                                width: 40%;
                                            }

                                            .width-60-percent {
                                                width: 60%;
                                            }

                                            .width-80-percent {
                                                width: 80%;
                                            }

                                            .width-100-percent {
                                                width: 100%;
                                            }
                                        </style>
                                        <div id="comments">
                                            <h2 class="woocommerce-Reviews-title">
                                                {{ $product->orderItems->where('review_status', 1)->count() }} review
                                                for
                                                <span>{{ $product->name }}</span>
                                            </h2>
                                            <ol class="commentlist">
                                                @foreach ($product->orderItems->where('review_status', 1) as $item)
                                                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                                                        id="li-comment-20">
                                                        <div id="comment-20" class="comment_container">
                                                            <img alt=""
                                                                 src="{{ asset('assets/images/profiles/'.$item->order->user->profile->image) }}"
                                                                 height="80" width="80">
                                                            <div class="comment-text">
                                                                <div class="star-rating">
                                                                    <span
                                                                        class="width-{{ $item->review->rating * 20 }}-percent">Rated
                                                                        <strong
                                                                            class="rating">{{ $item->review->rating }}</strong>
                                                                        out of 5</span>
                                                                </div>
                                                                <p class="meta">
                                                                    <strong
                                                                        class="woocommerce-review__author">{{ $item->order->user->name }}</strong>
                                                                    <span class="woocommerce-review__dash">–</span>
                                                                    <time class="woocommerce-review__published-date"
                                                                          datetime="2008-02-14 20:00">{{ $item->review->created_at }}</time>
                                                                </p>
                                                                <div class="description">
                                                                    <p>{{ $item->review->comment }}.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ol>
                                        </div><!-- #comments -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end main products area-->

                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                    <div class="widget widget-our-services ">
                        <div class="widget-content">
                            <ul class="our-services">

                                <li class="service">
                                    <a class="link-to-service">
                                        <i class="fa fa-truck" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Free Shipping</b>
                                            <span class="subtitle">On Oder Over $99</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service">
                                        <i class="fa fa-gift" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Special Offer</b>
                                            <span class="subtitle">Get a gift!</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>

                                <li class="service">
                                    <a class="link-to-service">
                                        <i class="fa fa-reply" aria-hidden="true"></i>
                                        <div class="right-content">
                                            <b class="title">Order Return</b>
                                            <span class="subtitle">Return within 7 days</span>
                                            <p class="desc">Lorem Ipsum is simply dummy text of the printing...</p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- Categories widget-->

                    <div class="widget mercado-widget widget-product">
                        <h2 class="widget-title">Popular Products</h2>
                        <div class="widget-content">
                            <ul class="products">
                                @foreach ($popular_products as $product)
                                    <li class="product-item">
                                        <div class="product product-widget-style">
                                            <div class="thumbnnail">
                                                <a href="{{ route('product.details', $product->slug) }}"
                                                   title="{{ $product->name }}">
                                                    <figure><img src="{{ $product->image }}" alt="{{ $product->name }}">
                                                    </figure>
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <a href="{{ route('product.details', $product->slug) }}"
                                                   class="product-name"><span>{{ $product->name }}</span></a>
                                                <div class="wrap-price"><span
                                                        class="product-price">${{ $product->name }}</span></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
                <!--end sitebar-->

                <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wrap-show-advance-info-box style-1 box-in-site">
                        <h3 class="title-box">Related Products</h3>
                        <div class="wrap-products">
                            <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                                 data-loop="false" data-nav="true" data-dots="false"
                                 data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>
                                @foreach ($related_products as $product)
                                    <div class="product product-style-2 equal-elem ">
                                        <div class="product-thumnail">
                                            <a href="{{ route('product.details', $product->slug) }}"
                                               title="{{ $product->name }}">
                                                <figure><img src="{{ $product->image }}" width="214" height="214"
                                                             alt="{{ $product->name }}">
                                                </figure>
                                            </a>
                                            <div class="group-flash">
                                                <span class="flash-item new-label">new</span>
                                            </div>
                                            <div class="wrap-btn">
                                                <a href="#" class="function-link">quick view</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <a href="{{ route('product.details', $product->slug) }}"
                                               class="product-name"><span>{{ $product->name }}</span></a>
                                            <div class="wrap-price"><span
                                                    class="product-price">${{ $product->regular_price }}</span></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--End wrap-products-->
                    </div>
                </div>

            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </main>
@endsection
@section('livewire-script')
    @livewireScripts
@endsection
