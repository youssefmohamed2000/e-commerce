@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                            <li class="breadcrumb-item active">Show Order</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Order Details</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4> Order Items</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td><img src="{{ $item->product->image }}" width="70"></td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>${{ $item->price * $item->quantity }}</td>
                                                <td>{{ $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Billing Details</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tr>
                                        <th>First Name</th>
                                        <td>{{ $order->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Name</th>
                                        <td>{{ $order->last_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td>{{ $order->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line 1</th>
                                        <td>{{ $order->line1 }}</td>
                                    </tr>
                                    <tr>
                                        <th>Line 2</th>
                                        <td>{{ $order->line2 ?? 'Empty' }}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{ $order->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Province</th>
                                        <td>{{ $order->province }}</td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td>{{ $order->country }}</td>
                                    </tr>
                                    <tr>
                                        <th>ZipCode</th>
                                        <td>{{ $order->zipcode }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

                @if ($order->is_shipping_different == 1)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Shipping Details</h5>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
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
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Transaction Details</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
