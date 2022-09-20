@extends('front.layouts.index')
@section('title')
    <title>Cart</title>
@endsection
@section('livewire-style')
    @livewireStyles
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                    <li class="item-link"><span>Cart</span></li>
                </ul>
            </div>
            @include('partials._session')
            <br>
            <div class=" main-content-area">

                @livewire('cart')

                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <h3 class="title-box">Most Viewed Products</h3>
                    <div class="wrap-products">
                        <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5"
                             data-loop="false" data-nav="true" data-dots="false"
                             data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}'>

                            @foreach($most_viewed as $product)
                                <div class="product product-style-2 equal-elem ">
                                    <div class="product-thumnail">
                                        <a title="{{$product->name}}">
                                            <figure><img src="{{$product->image}}"
                                                         width="214" height="214"
                                                         alt="{{$product->name}}">
                                            </figure>
                                        </a>
                                        <div class="group-flash">
                                            <span class="flash-item sale-label">hot</span>
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="{{route('product.details' , $product->slug)}}"
                                               class="function-link">quick view</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a class="product-name"><span>{{$product->name}}</span></a>
                                        <div class="wrap-price"><span
                                                class="product-price">${{$product->regular_price}}</span></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!--End wrap-products-->
                </div>

            </div>
            <!--end main content area-->
        </div>
        <!--end container-->

    </main>
    <!--main area-->
@endsection
@section('livewire-script')
    @livewireScripts
@endsection
