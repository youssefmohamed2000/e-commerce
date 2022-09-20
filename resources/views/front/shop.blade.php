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

    {{-- <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [1, 100],
            connect: true,
            range: {
                'min': 0,
                'max': 1000
            },
            pips: {
                mode: 'steps',
                stepped: true,
                density: 4
            }
        });
        slider.noUiSlider.on('update', function(value) {
            @this.set('min_price', value[0]);
            @this.set('max_price', value[1]);
        });
    </script> --}}
@endsection
@section('livewire-script')
    @livewireScripts
@endsection
