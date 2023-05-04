@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                                <a type="button" href=" {{ route('admin.products.create') }}"
                                   class="btn  btn-info btn-lg">Add New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Sale Price</th>
                                        <th>Image</th>
                                        <th>Stock</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->regular_price }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td><img src="{{ $product->image }}" width="60"></td>
                                            <td>{{ $product->stock_status }}</td>
                                            <td>{{ date('d-m-Y', strtotime($product->created_at)) }}
                                            </td>
                                            <td>
                                                <a type="button"
                                                   href="{{ route('admin.products.attributes.index', $product->slug) }}"
                                                   class="btn btn-warning"><i class="fa fa-plus"></i> Attr</a>
                                                <a type="button"
                                                   href="{{ route('admin.products.edit', $product->slug) }}"
                                                   class="btn btn-info"><i class="fa fa-edit"> Edit</i></a>
                                                <button form="delete{{ $product->slug }}" type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item')">
                                                    <i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                                <form id="delete{{ $product->slug }}"
                                                      action="{{ route('admin.products.destroy', $product->slug) }}"
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
