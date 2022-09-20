@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                                <a type="button" href=" {{ route('admin.categories.create') }}"
                                   class="btn btn-info btn-lg">Add New</a>
                                <a type="button" style="float: right;" href=" {{ route('admin.categories.manage') }}"
                                   class="btn btn-info btn-lg">Manage HomePage Categories</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Sub Categories</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $index => $category)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <ul>
                                                    @foreach($category->subCategories as $sub)
                                                        <li>
                                                            <i class="fa fa-caret-right"></i> {{$sub->name}} <a
                                                                type="button"
                                                                href="{{ route('admin.categories.edit',['slug'=> $category->slug , 'sub_slug'=> $sub->slug]) }}"
                                                            ><i class="fa fa-edit"></i></a>
                                                            <button form="delete{{ $sub->slug }}" type="submit"
                                                                    class="btn btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this item')">
                                                                <i
                                                                    class="fa fa-times text-danger"></i>
                                                            </button>
                                                            <form id="delete{{ $sub->slug }}"
                                                                  action="{{ route('admin.categories.destroy', ['slug'=> $category->slug , 'sub_slug'=> $sub->slug]) }}"
                                                                  method="POST">@csrf @method('delete')</form>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <a type="button"
                                                   href="{{ route('admin.categories.edit', $category->slug) }}"
                                                   class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                <button form="delete{{ $category->slug }}" type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item')">
                                                    <i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                                <form id="delete{{ $category->slug }}"
                                                      action="{{ route('admin.categories.destroy', $category->slug) }}"
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
