@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                @include('partials._errors')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Create Coupon</h3>
                            </div>
                            <form action="{{ route('admin.coupons.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input type="text" class="form-control" {{ old('code') }} name="code"
                                            placeholder="Enter Code">
                                    </div>
                                    <div class="form-group">
                                        <label>Coupon Type</label>
                                        <select name="type" class="form-control">
                                            <option selected disabled>Choose One ......</option>
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Coupon Value</label>
                                        <input type="number" class="form-control" {{ old('value') }} name="value"
                                            min="0" step="0.01" placeholder="Enter Coupon Value">
                                    </div>
                                    <div class="form-group">
                                        <label>Cart Value</label>
                                        <input type="number" class="form-control" {{ old('cart_value') }} min="0"
                                            step="0.01" placeholder="Enter Cart Value" name="cart_value">
                                    </div>

                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" class="form-control" name="expiry_date" id="expiry-date">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Create</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
            </div>
        </section>
    </div><!-- /.container-fluid -->
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#expiry-date').datetimepicker({
                    format: 'Y-MM-DD'
                })
                .on('dp.change', function(ev) {

                });
        });
    </script>
@endsection
