@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Attribute</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.products.index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('admin.products.attributes.index' , $product->slug) }}">Product
                                    Attributes</a>
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
                                <h3 class="card-title">Edit Attribute</h3>
                            </div>
                            <form
                                action="{{ route('admin.products.attributes.update' ,['product_slug' =>$product->slug ,'id' => $attribute_value->id]) }}"
                                method="POST">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Attribute Name</label>
                                        <select name="product_attribute_id" class="form-control">
                                            @foreach($attributes as $attribute)
                                                <option value="{{$attribute->id}}"
                                                    {{$attribute->id == $attribute_value->product_attribute_id ? 'selected' : ''}}>
                                                    {{$attribute->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Attribute Value</label>
                                        <input type="text" name="value" value="{{$attribute_value->value}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
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
