@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.categories.index') }}">Categories</a>
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
                            @if(request()->has('sub_slug'))
                                <div class="card-header">
                                    <h3 class="card-title">Edit ({{ $sub_category->name }})</h3>
                                </div>
                                <form
                                    action="{{ route('admin.categories.update',['slug' => $sub_category->category->slug , 'sub_slug' =>$sub_category->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ $sub_category->name }}"
                                                   name="name" placeholder="Enter Name" required>

                                        </div>
                                        <div class="form-group">
                                            <label>Parent Category</label>
                                            <select name="parent_category_id" class="form-control">
                                                <option value="">None</option>
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{$category->id}}" {{$sub_category->category_id == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </form>
                            @else
                                <div class="card-header">
                                    <h3 class="card-title">Edit ({{ $category->name }})</h3>
                                </div>
                                <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{ $category->name }}"
                                                   name="name" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
