@extends('front.layouts.index')
@section('title')
    <title>Order Details</title>
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
                    <li class="item-link"><a href="{{ route('orders.index') }}" class="link">Orders</a></li>
                    <li class="item-link"><span>Order Details</span></li>
                </ul>
            </div>

            <div class=" main-content-area">
                <div class="container" style="padding: 30px 0;">
                    <div class="row">
                        <div class="col-md-12">
                            @include('partials._session')
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5> Order Details </h5>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('orders.index') }}" class="btn btn-success pull-right">My
                                                Orders</a>
                                            @if ($order->status == 'ordered')
                                                <button type="submit" form="update{{ $order->id }}"
                                                    class="btn btn-warning pull-right" style="margin-right:20px;">Cancel
                                                    Order</button>
                                                <form id="update{{ $order->id }}"
                                                    action="{{ route('orders.update', $order->id) }}" method="POST">@csrf
                                                    @method('put')</form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <th>Order Id</th>
                                            <td>{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Order Date</th>
                                            <td>{{ date('Y-m-d', strtotime($order->created_at)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $order->status }}</td>
                                        </tr>
                                        <tr>
                                            @if ($order->status == 'delivered')
                                                <th>Delivery Date</th>
                                                <td>{{ $order->delivered_date }}</td>
                                            @elseif($order->status == 'canceled')
                                                <th>Cancelation Date</th>
                                                <td>{{ $order->canceled_date }}</td>
                                            @endif
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5> Orders Items </h5>
                                </div>
                                <div class="panel-body">
                                    <div class="wrap-iten-in-cart">
                                        <h3 class="box-title">Products Name</h3>
                                        <ul class="products-cart">
                                            @foreach ($order->orderItems as $item)
                                                <li class="pr-cart-item">
                                                    <div class="product-image">
                                                        <figure><img src="{{ $item->product->image }}"
                                                                alt="{{ $item->product->name }}">
                                                        </figure>
                                                    </div>
                                                    <div class="product-name">
                                                        <a class="link-to-product"
                                                            href="{{ route('product.details', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                    </div>
                                                    @if($item->options)
                                                        <div class="product-name">
                                                            @foreach(unserialize($item->options) as $key => $value)
                                                                <p><b>{{$key}}: {{$value}}</b></p>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <div class="price-field produtc-price">
                                                        <p class="price">${{ $item->price }}</p>
                                                    </div>
                                                    <div class="quantity">
                                                        <h5>{{ $item->quantity }}</h5>
                                                    </div>
                                                    <div class="price-field sub-total">
                                                        <p class="price">${{ $item->price * $item->quantity }}</p>
                                                    </div>
                                                    @if ($order->status == 'delivered' && $item->review_status == false)
                                                        <div class="price-field sub-total">
                                                            <p class="price"><a href="{{ route('review.create',$item->id) }}">Write Review</a></p>
                                                        </div>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="summary">
                                        <div class="order-summary">
                                            <h4 class="title-box">Order Summary</h4>
                                            <p class="summary-info"><span class="title">Subtotal</span><b
                                                    class="index">${{ $order->subtotal }}</b>
                                            </p>
                                            <p class="summary-info"><span class="title">Tax</span><b
                                                    class="index">${{ $order->tax }}</b>
                                            </p>
                                            <p class="summary-info"><span class="title">Shipping</span><b
                                                    class="index">Free Shipping</b>
                                            </p>
                                            <p class="summary-info"><span class="title">Total</span><b
                                                    class="index">${{ $order->total }}</b>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5>Billing Details</h5>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <th>First Name</th>
                                            <td>{{ $order->first_name }}</td>
                                            <th>Last Name</th>
                                            <td>{{ $order->last_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td>{{ $order->mobile }}</td>
                                            <th>Email</th>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Line 1</th>
                                            <td>{{ $order->line1 }}</td>
                                            <th>Line 2</th>
                                            <td>{{ $order->line2 ?? 'Empty' }}</td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td>{{ $order->city }}</td>
                                            <th>Province</th>
                                            <td>{{ $order->province }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>{{ $order->country }}</td>
                                            <th>ZipCode</th>
                                            <td>{{ $order->zipcode }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($order->is_shipping_different == 1)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h5>Shipping Details</h5>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th>First Name</th>
                                                <td>{{ $order->shipping->first_name }}</td>
                                                <th>Last Name</th>
                                                <td>{{ $order->shipping->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Mobile</th>
                                                <td>{{ $order->shipping->mobile }}</td>
                                                <th>Email</th>
                                                <td>{{ $order->shipping->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Line 1</th>
                                                <td>{{ $order->shipping->line1 }}</td>
                                                <th>Line 2</th>
                                                <td>{{ $order->shipping->line2 ?? 'Empty' }}</td>
                                            </tr>
                                            <tr>
                                                <th>City</th>
                                                <td>{{ $order->shipping->city }}</td>
                                                <th>Province</th>
                                                <td>{{ $order->shipping->province }}</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td>{{ $order->shipping->country }}</td>
                                                <th>ZipCode</th>
                                                <td>{{ $order->shipping->zipcode }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5>Transaction Details</h5>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tr>
                                            <th>Transaction Mode</th>
                                            <td>{{ $order->transaction->mode }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $order->transaction->status }}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaction Date</th>
                                            <td>{{ date('d-m-Y', strtotime($order->transaction->created_at)) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end main content area-->
        </div>
        <!--end container-->
    </main>
    <!--main area-->
@endsection
