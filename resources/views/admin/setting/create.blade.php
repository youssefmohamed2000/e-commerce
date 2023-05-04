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
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.settings.index') }}">Settings</a></li>
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
                                <h3 class="card-title">Create Settings</h3>
                            </div>
                            <form action="{{ route('admin.settings.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" {{ old('email') }} name="email"
                                               placeholder="Enter Email"  required>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" class="form-control" {{ old('phone') }} name="phone"
                                               placeholder="Enter Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone 2</label>
                                        <input type="number" class="form-control" {{ old('phone2') }} name="phone2"
                                               placeholder="Enter Phone Number" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" {{ old('address') }} name="address"
                                               placeholder="Enter Address" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Map</label>
                                        <input type="text" class="form-control" {{ old('map') }} name="map"
                                               placeholder="Enter Map" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Twitter Link</label>
                                        <input type="text" class="form-control" {{ old('twitter') }} name="twitter" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Facebook Link</label>
                                        <input type="text" class="form-control" {{ old('facebook') }} name="facebook" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Pinterest Link</label>
                                        <input type="text" class="form-control" {{ old('pinterest') }} name="pinterest" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Instagram Link</label>
                                        <input type="text" class="form-control" {{ old('instagram') }} name="instagram" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Youtube Link</label>
                                        <input type="text" class="form-control" {{ old('youtube') }} name="youtube" required>
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
