@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Attributes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                            <li class="breadcrumb-item active">Attributes</li>
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

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Attribute Name</th>
                                        <th>Attribute Value</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($product->attributeValues as $item)
                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td>{{$item->productAttributes->name}}</td>
                                            <td>{{$item->value}}</td>
                                            <td>dff</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="4">There are No Attributes for this Product</th>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                {{--@livewire('admin.add-attribute-value' , [ 'product' => $product , 'attributes' =>
                                                                $attributes])--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
