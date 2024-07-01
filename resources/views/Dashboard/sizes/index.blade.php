@extends('layouts.admin')

@section('title', trans('admin.sizes'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.sizes') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.sizes') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            @if (auth('user')->user()->has_permission('create-sizes'))
              <a href="{{route('dashboard.sizes.create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
            @else
              <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
            @endif
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('admin.Name') }}</th>
                <th>{{ trans('admin.Created at') }}</th>
                <th>{{ trans('admin.Actions') }}</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($sizes as $size)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{$size->name}}</td>
                          <td>{{$size->created_at}}</td>
                          <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  @if (auth('user')->user()->has_permission('update-sizes'))
                                    <a class="dropdown-item" href="{{route('dashboard.sizes.edit',$size->id)}}">{{ trans('admin.Edit') }}</a>
                                  @endif

                                  @if (auth('user')->user()->has_permission('delete-sizes'))
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default-{{$size->id}}">{{ trans('admin.Delete') }}</a>
                                  @endif
                                </div>
                              </div>

                              @include('Dashboard.partials.delete_confirmation', [
                                'url' => route('dashboard.sizes.destroy',$size->id),
                                'modal_id'  => 'modal-default-' . $size->id,
                              ])
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script>
  $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        //role filter
        var role = $('#role').val();
        if(data[3] === role || role == ''){ var role_status = true } else { var role_status = false};

        if(role_status)
          return true;

        return false;
      }
  );

  $(document).ready(function () {
      // filter
      $('#role').on('change', function () {
        table1.draw().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
  });
</script>
@endsection