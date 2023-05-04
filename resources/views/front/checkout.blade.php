@extends('front.layouts.index')
@section('title')
    <title>Checkout</title>
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">home</a></li>
                    <li class="item-link"><span>Check Out</span></li>
                </ul>
            </div>
            <div class=" main-content-area">
                @if (Session::has('checkout') &&
                    Cart::instance('cart')->content()->count() > 0)
                    <form action="{{ route('checkout.store') }}" method="POST" onsubmit="$('#proccessing').show();">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wrap-address-billing">
                                    <h3 class="box-title">Billing Address</h3>
                                    <div class="billing-address">
                                        <p class="row-in-form">
                                            <label for="first_name">first name<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="Your first name" required>
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="last_name">last name<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="Your last name" required>
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="email">Email Addreess:<span>*</span></label>
                                            <input type="email" name="email" placeholder="Type your email"
                                                   value="{{$profile->user->email}}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="mobile">Phone number<span>*</span></label>
                                            <input type="number" name="mobile" placeholder="10 digits format"
                                                   value="{{$profile->mobile}}" required>
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="add">Line1:<span>*</span></label>
                                            <input type="text" name="line1" placeholder="Street at apartment number"
                                                   value="{{$profile->line1}}" required>
                                            @error('line1')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="add">Line2:</label>
                                            <input type="text" name="line2" placeholder="Street at apartment number"
                                                   value="{{$profile->line2}}">
                                        </p>
                                        <p class="row-in-form">
                                            <label for="country">Country<span>*</span></label>
                                            <input type="text" name="country" placeholder="United States"
                                                   value="{{$profile->country}}" required>
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="province">Province<span>*</span></label>
                                            <input type="text" name="province" placeholder="Province"
                                                   value="{{$profile->province}}" required>
                                            @error('province')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="city">Town / City<span>*</span></label>
                                            <input type="text" name="city" placeholder="City name"
                                                   value="{{$profile->city}}" required>
                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="zip-code">Postcode / ZIP:<span>*</span></label>
                                            <input type="number" name="zipcode" value="{{$profile->zipcode}}"
                                                   placeholder="Your postal code" required>
                                            @error('zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form fill-wife">
                                            <label class="checkbox-field">
                                                <input name="is_shipping_different" id="different-add" value="1"
                                                       type="checkbox">
                                                <span>Ship to a different address?</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="box" style="display: none">
                                <div class="wrap-address-billing">
                                    <h3 class="box-title">Shipping Address</h3>
                                    <div class="billing-address">
                                        <p class="row-in-form">
                                            <label for="first_name">first name<span>*</span></label>
                                            <input type="text" name="s_first_name" placeholder="Your first name">
                                            @error('s_first_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="last_name">last name<span>*</span></label>
                                            <input type="text" name="s_last_name" placeholder="Your last name">
                                            @error('s_last_name')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="email">Email Addreess:</label>
                                            <input type="email" name="s_email" placeholder="Type your email">
                                            @error('s_email')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="mobile">Phone number<span>*</span></label>
                                            <input type="number" name="s_mobile" placeholder="10 digits format">
                                            @error('s_mobile')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="add">Line1:</label>
                                            <input type="text" name="s_line1"
                                                   placeholder="Street at apartment number">
                                            @error('s_line1')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="add">Line2:</label>
                                            <input type="text" name="s_line2"
                                                   placeholder="Street at apartment number">
                                        </p>
                                        <p class="row-in-form">
                                            <label for="country">Country<span>*</span></label>
                                            <input type="text" name="s_country" placeholder="United States">
                                            @error('s_country')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="province">Province<span>*</span></label>
                                            <input type="text" name="s_province" placeholder="Province">
                                            @error('s_province')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="city">Town / City<span>*</span></label>
                                            <input type="text" name="s_city" placeholder="City name">
                                            @error('s_city')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="row-in-form">
                                            <label for="zip-code">Postcode / ZIP:</label>
                                            <input type="number" name="s_zipcode" placeholder="Your postal code">
                                            @error('s_zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="summary summary-checkout">
                            <div class="summary-item payment-method">
                                <h4 class="title-box">Payment Method</h4>
                                <div class="wrap-address-billing" id="visa" style="display: none">
                                    <p class="row-in-form">
                                        <label for="card_number">Card Number:</label>
                                        <input type="text" name="card_number" placeholder="Your Card Number">
                                        @error('card_number')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="exp_month">Expiry Month:</label>
                                        <input type="text" name="exp_month" placeholder="MM">
                                        @error('exp_month')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="exp_year">Expiry Year:</label>
                                        <input type="text" name="exp_year" placeholder="YYYY">
                                        @error('exp_year')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>
                                    <p class="row-in-form">
                                        <label for="cvc">CVC:</label>
                                        <input type="password" name="cvc" placeholder="Your Card Number">
                                        @error('cvc')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </p>
                                </div>
                                <div class="choose-payment-methods">
                                    <label class="payment-method">
                                        <input name="payment_method" id="payment-method-bank" value="cod"
                                               type="radio" onclick="show2();">
                                        <span>Cash on Delivery</span>
                                        <span class="payment-desc">Order now and Pay on Delivery</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="payment_method" id="payment-method-visa" value="card"
                                               type="radio" onclick="show1();">
                                        <span>Debit/Credit Card</span>
                                        <span class="payment-desc">There are many variations of passages of Lorem Ipsum
                                            available</span>
                                    </label>
                                    <label class="payment-method">
                                        <input name="payment_method" id="payment-method-paypal" value="paypal"
                                               type="radio" onclick="show2();">
                                        <span>Paypal</span>
                                        <span class="payment-desc">You can pay with your credit</span>
                                        <span class="payment-desc">card if you don't have a paypal account</span>
                                    </label>
                                    @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <p class="summary-info grand-total"><span>Grand Total</span> <span
                                        class="grand-total-price">${{ Session::get('checkout')['total'] }}</span></p>
                                @if($errors->isEmpty())
                                    <div id="proccessing"
                                         style="font-size: 22px;margin-bottom: 20px;padding-left: 37px;color: green;display: none">
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-medium">Place order now</button>
                            </div>
                            <div class="summary-item shipping-method">
                                <h4 class="title-box f-title">Shipping method</h4>
                                <p class="summary-info"><span class="title">Flat Rate</span></p>
                                <p class="summary-info"><span class="title">Fixed $0.00</span></p>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="text-center" style="padding: 30px 0;">
                        <h1>You have to make Ckeckout First</h1>
                        <p>Go to your cart and make Checkout</p>
                        <a href="{{ route('cart') }}" class="btn btn-danger">Go to Cart</a>
                    </div>
                @endif
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
    <!--main area-->
@endsection
@section('scripts')
    <script>
        const checkbox = document.getElementById('different-add');

        const box = document.getElementById('box');

        checkbox.addEventListener('click', function handleClick() {
            if (checkbox.checked) {
                box.style.display = 'block';
            } else {
                box.style.display = 'none';
            }
        });
    </script>
    <script>
        function show1() {
            document.getElementById('visa').style.display = 'block';
        }

        function show2() {
            document.getElementById('visa').style.display = 'none';
        }
    </script>
@endsection
