@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Settings</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                                <a type="button" href=" {{ route('admin.settings.edit',$setting->id) }}"
                                   class="btn btn-info btn-lg">Edit Settings</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                @if($setting)
                                    <table class="table">
                                        <tr>
                                            <th>email</th>
                                            <td>{{$setting->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>phone</th>
                                            <td>{{$setting->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>phone2</th>
                                            <td>{{$setting->phone2}}</td>
                                        </tr>
                                        <tr>
                                            <th>address</th>
                                            <td>{{$setting->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>map</th>
                                            <td>{{$setting->map}}</td>
                                        </tr>
                                        <tr>
                                            <th>twitter</th>
                                            <td>{{$setting->twitter}}</td>
                                        </tr>
                                        <tr>
                                            <th>facebook</th>
                                            <td>{{$setting->facebook}}</td>
                                        </tr>
                                        <tr>
                                            <th>pinterest</th>
                                            <td>{{$setting->pinterest}}</td>
                                        </tr>
                                        <tr>
                                            <th>instagram</th>
                                            <td>{{$setting->instagram}}</td>
                                        </tr>
                                        <tr>
                                            <th>youtube</th>
                                            <td>{{$setting->youtube}}</td>
                                        </tr>

                                    </table>
                                @else
                                    <p>There are no default settings
                                        <a type="button" href=" {{ route('admin.settings.create') }}"
                                           class="btn btn-info">Add New</a></p>
                                @endif
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
