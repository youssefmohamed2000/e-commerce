@extends('admin.layouts.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Attributes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
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
                                <a type="button" href=" {{ route('admin.attributes.create') }}"
                                   class="btn btn-info btn-lg">Add New</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($attributes as $index => $attribute)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $attribute->name }}</td>
                                            <td>{{ $attribute->created_at }}</td>
                                            <td>
                                                <a type="button"
                                                   href="{{ route('admin.attributes.edit', $attribute->slug) }}"
                                                   class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                                                <button form="delete{{ $attribute->slug }}" type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item')">
                                                    <i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                                <form id="delete{{ $attribute->slug }}"
                                                      action="{{ route('admin.attributes.destroy', $attribute->slug) }}"
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
