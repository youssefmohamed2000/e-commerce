@extends('front.layouts.index')
@section('title')
    <title>Wishlist</title>
@endsection
@section('livewire-style')
    @livewireStyles
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site left-sidebar">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
                    <li class="item-link"><a href="{{ route('shop') }}" class="link">Shop</a></li>
                    <li class="item-link"><span>Wishlist</span></li>
                </ul>
            </div>
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
            @livewire('wishlist')
        </div>
    </main>
@endsection
@section('livewire-script')
    @livewireScripts
@endsection
