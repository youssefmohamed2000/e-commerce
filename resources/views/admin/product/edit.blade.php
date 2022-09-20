@extends('admin.layouts.index')

@section('livewire-style')
    @livewireStyles
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.products.index') }}">Products</a>
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
                                <h3 class="card-title">Edit ({{ $product->name }})</h3>
                            </div>
                            <form action="{{ route('admin.products.update', $product->slug) }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" value=" {{ $product->name }}"
                                               name="name" placeholder="Enter Product Name">
                                    </div>
                                    @livewire('admin.get-sub-categories' , ['categories' => $categories
                                    ,'category_id' => $product->category_id,
                                    'product' => $product])
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_description"
                                                  placeholder="Enter Short Description">{{ $product->short_description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Description</label>
                                        <textarea class="form-control" name="description"
                                                  placeholder="Enter Product Description">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Regular Price</label>
                                        <input type="number" class="form-control" value="{{ $product->regular_price }}"
                                               name="regular_price" placeholder="Enter Regular Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Sale Price</label>
                                        <input type="number" class="form-control" value="{{ $product->sale_price }}"
                                               name="sale_price" placeholder="Enter Sale Price">
                                    </div>
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" class="form-control" name="SKU"
                                               value="{{ $product->SKU }}" placeholder="Enter SKU">
                                    </div>
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <select name="stock_status" class="form-control">
                                            <option disabled selected>Choose One</option>
                                            <option value="instock"
                                                {{ $product->stock_status == 'instock' ? 'selected' : '' }}>In Stock
                                            </option>
                                            <option value="outofstock"
                                                {{ $product->stock_status == 'outofstock' ? 'selected' : '' }}>Out Of
                                                Stock
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Featured</label>
                                        <select name="featured" class="form-control">
                                            <option selected value="0"
                                                {{ $product->featured == 0 ? 'selected' : '' }}>NO
                                            </option>
                                            <option value="1" {{ $product->featured == 1 ? 'selected' : '' }}>YES
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" class="form-control" name="quantity"
                                               value="{{ $product->quantity }}" placeholder="Enter Quantity">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="form-group">
                                        <label>Product Gallary</label>
                                        <input type="file" multiple class="form-control" name="images[]">
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

@section('livewire-script')
    @livewireScripts
@endsection
