@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Setting</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.settings.index') }}">Settings</a>
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

                            <form action="{{ route('admin.settings.update',$setting->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{$setting->email}}"
                                               name="email"
                                               placeholder="Enter Email">
                                    </div>

                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" class="form-control" value="{{$setting->phone}}"
                                               name="phone"
                                               placeholder="Enter Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label>Phone 2</label>
                                        <input type="number" class="form-control" value="{{$setting->phone2}}"
                                               name="phone2"
                                               placeholder="Enter Phone Number">
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" value="{{$setting->address}}"
                                               name="address"
                                               placeholder="Enter Address">
                                    </div>

                                    <div class="form-group">
                                        <label>Map</label>
                                        <input type="text" class="form-control" value="{{$setting->map}}" name="map"
                                               placeholder="Enter Map">
                                    </div>

                                    <div class="form-group">
                                        <label>Twitter Link</label>
                                        <input type="text" class="form-control" value="{{$setting->twitter}}"
                                               name="twitter">
                                    </div>

                                    <div class="form-group">
                                        <label>Facebook Link</label>
                                        <input type="text" class="form-control" value="{{$setting->facebook}}"
                                               name="facebook">
                                    </div>

                                    <div class="form-group">
                                        <label>Pinterest Link</label>
                                        <input type="text" class="form-control" value="{{$setting->pinterest}}"
                                               name="pinterest">
                                    </div>

                                    <div class="form-group">
                                        <label>Instagram Link</label>
                                        <input type="text" class="form-control" value="{{$setting->instagram}}"
                                               name="instagram">
                                    </div>

                                    <div class="form-group">
                                        <label>Youtube Link</label>
                                        <input type="text" class="form-control" value="{{$setting->youtube}}"
                                               name="youtube">
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
