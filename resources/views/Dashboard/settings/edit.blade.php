@extends('layouts.admin')

@section('title', trans('admin.Settings'))

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Settings') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Settings') }}</li>
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
                <h3 class="card-title">{{ trans('admin.Edit') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                @include('components.form.input', [
                                    'class' => 'form-control',
                                    'name' => "site_name",
                                    'label' => trans('admin.Site name'),
                                    'value' => isset($data) ? $data->site_name : old('site_name'),
                                    'attribute' => 'required',
                                ])
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ trans('admin.Time zones') }}</label>
                                    <select class="form-control select2" style="width: 100%;" name="time_zone">
                                        @foreach (config('time_zones.blade') as $time_zone)
                                            <option value="{{$time_zone['name']}}" @if ($data->time_zone == $time_zone['name']) selected @endif>{{$time_zone['name']}}</option>
                                        @endforeach>
                                    </select>
                                    @error('time_zone')
                                        <span style="color: red; margin: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ trans('admin.Date format') }}</label>
                                    <select class="form-control select2" style="width: 100%;" name="date_format">
                                        @foreach (config('date_formats.blade') as $date_format)
                                            <option value="{{$date_format['format']}}" @if ($data->date_format == $date_format['format']) selected @endif>{{date($date_format['format'])}}</option>
                                        @endforeach>
                                    </select>
                                    @error('date_formats')
                                        <span style="color: red; margin: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('admin.Save') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection


