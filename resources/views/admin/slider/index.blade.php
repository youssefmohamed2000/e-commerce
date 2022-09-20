@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sliders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Sliders</li>
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
                                <a type="button" href=" {{ route('admin.sliders.create') }}"
                                    class="btn  btn-info btn-lg">Add New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $index => $slider)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><img src="{{ $slider->image }}" width="120"></td>
                                                <td>{{ $slider->title }}</td>
                                                <td>{{ $slider->status == 1 ? 'active' : 'inactive' }}</td>
                                                <td>{{ date('d-m-Y', strtotime($slider->created_at)) }}</td>
                                                <td>
                                                    <a type="button"
                                                        href="{{ route('admin.sliders.edit', $slider->slug) }}"
                                                        class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                    <button form="delete{{ $slider->slug }}" type="submit"
                                                        class="btn btn-danger"><i class="fa fa-trash"
                                                            onclick="return confirm('Are you sure you want to delete this item')"></i>
                                                        Delete</button>
                                                    <form id="delete{{ $slider->slug }}"
                                                        action="{{ route('admin.sliders.destroy', $slider->slug) }}"
                                                        method="POST">@csrf @method('delete')</form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
