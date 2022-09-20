@extends('front.layouts.index')
@section('title')
    <title>Orders</title>
@endsection
@section('content')
    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ route('home') }}" class="link">Home</a></li>
                    <li class="item-link"><span>Orders</span></li>
                </ul>
            </div>

            <div class=" main-content-area">
                <div class="container" style="padding: 30px 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    All Orders
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Subtotal</th>
                                                <th>Discount</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>ZipCode</th>
                                                <th>Status</th>
                                                <th>Order Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>${{ $order->subtotal }}</td>
                                                    <td>${{ $order->discount }}</td>
                                                    <td>${{ $order->tax }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>{{ $order->first_name }}</td>
                                                    <td>{{ $order->last_name }}</td>
                                                    <td>{{ $order->mobile }}</td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>{{ $order->zipcode }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                                                    <td>
                                                        <a type="button" href="{{ route('orders.show', $order->id) }}"
                                                            class="btn btn-info">Details</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <h4>Your Orders list is Empty Go <a href="{{ route('shop') }}">Shop Now</a>
                                                    to make New Orders
                                                </h4>
                                            @endforelse
                                        </tbody>
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
