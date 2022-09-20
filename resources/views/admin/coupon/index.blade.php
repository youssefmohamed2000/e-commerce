@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupons</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">coupons</li>
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
                                <a type="button" href=" {{ route('admin.coupons.create') }}"
                                    class="btn btn-info btn-lg">Add New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Type</th>
                                            <th>Value</th>
                                            <th>Cart Value</th>
                                            <th>Expiry Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $index => $coupon)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->type }}</td>
                                                @if ($coupon->type == 'fixed')
                                                    <td>${{ $coupon->value }}</td>
                                                @else
                                                    <td>{{ $coupon->value }}%</td>
                                                @endif
                                                <td>{{ $coupon->cart_value }}</td>
                                                <td>{{ $coupon->expiry_date }}</td>
                                                <td>
                                                    <a type="button"
                                                        href="{{ route('admin.coupons.edit', $coupon->slug) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                    <button form="delete{{ $coupon->slug }}" type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item')"><i
                                                            class="fa fa-trash"></i> Delete</button>
                                                    <form id="delete{{ $coupon->slug }}"
                                                        action="{{ route('admin.coupons.destroy', $coupon->slug) }}"
                                                        method="POST">@csrf @method('delete')</form>
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
