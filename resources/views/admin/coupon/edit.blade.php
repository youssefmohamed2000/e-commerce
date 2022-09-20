@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.coupons.index') }}">Coupons</a>
                            </li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h3 class="card-title">Edit ({{ $coupon->name }})</h3>
                            </div>
                            <form action="{{ route('admin.coupons.update', $coupon->slug) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Coupon Code</label>
                                        <input type="text" class="form-control" value="{{ $coupon->code }}"
                                            name="code" placeholder="Enter Code">
                                        <input type="hidden" value="{{ $coupon->id }}" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label>Coupon Type</label>
                                        <select name="type" class="form-control">
                                            <option disabled>Choose One ......</option>
                                            <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>fixed
                                            </option>
                                            <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>
                                                percent
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Coupon Value</label>
                                        <input type="number" class="form-control" value="{{ $coupon->value }}"
                                            min="0" step="0.01" name="value">
                                    </div>
                                    <div class="form-group">
                                        <label>Cart Value</label>
                                        <input type="number" class="form-control" value="{{ $coupon->cart_value }}"
                                            min="0" step="0.01" name="cart_value">
                                    </div>
                                    <div class="form-group">
                                        <label>Expiry Date</label>
                                        <input type="text" class="form-control" value="{{ $coupon->expiry_date }}"
                                            name="expiry_date" id="expiry-date">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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
