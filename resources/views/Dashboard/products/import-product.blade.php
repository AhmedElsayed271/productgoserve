@extends('layouts.admin')

@section('title', trans('admin.products'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.products') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / <a href="{{route('dashboard.products.index')}}">{{ trans('admin.products') }}</a> / {{ trans('admin.Create') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">{{ trans('admin.Create') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="{{ route('dashboard.products.import.products') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- /.card-body -->
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleInputFile">الملف</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="excel" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('excel')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('admin.Add') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
