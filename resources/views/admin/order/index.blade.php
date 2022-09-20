@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <section class="content">
            <div class="container-fluid">
                @include('partials._session')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
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
                                            <th colspan="2" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
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
                                                    <a type="button" href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="btn btn-info">Details</a>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" name="status"
                                                            class="btn btn-success dropdown-toggle dropdown-icon"
                                                            data-toggle="dropdown">Status
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu">
                                                            <button class="dropdown-item" form="update{{ $order->id }}"
                                                                type="submit" name="status"
                                                                value="delivered">Delivered</button>
                                                            <button class="dropdown-item" form="update{{ $order->id }}"
                                                                type="submit" name="status"
                                                                value="canceled">Canceled</button>
                                                        </div>
                                                        <form id="update{{ $order->id }}"
                                                            action="{{ route('admin.orders.update', $order->id) }}"
                                                            method="POST">@csrf @method('put')</form>
                                                    </div>
                                                </td>
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
            </div>
        </section>
    </div>
@endsection
