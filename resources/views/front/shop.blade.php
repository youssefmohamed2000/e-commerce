@extends('front.layouts.index')
@section('title')
    <title>Shop</title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css"
          integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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
                    <li class="item-link"><span>Shop</span></li>
                </ul>
            </div>

            @livewire('shop' , ['popular_products' => $popular_products])
        </div>
        <!--end container-->
    </main>
    <!--main area-->
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"
            integrity="sha512-1mDhG//LAjM3pLXCJyaA+4c+h5qmMoTc7IuJyuNNPaakrWT9rVTxICK4tIizf7YwJsXgDC2JP74PGCc7qxLAHw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
@section('livewire-script')
    @livewireScripts
@endsection
