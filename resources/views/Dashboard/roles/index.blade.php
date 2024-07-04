@extends('layouts.admin')

@section('title', 'Roles')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Roles') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Roles') }}</li>
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
              @if (auth('user')->user()->has_permission('create-roles'))
                <a href="{{route('dashboard.roles.create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
              @else
                <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('admin.Name') }}</th>
                    <th>{{ trans('admin.Description') }}</th>
                    <th>{{ trans('admin.Created at') }}</th>
                    <th>{{ trans('admin.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->display_name}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                      @if (auth('user')->user()->has_permission('update-roles'))
                                        <a class="dropdown-item" href="{{route('dashboard.roles.edit', $role->id)}}">{{ trans('admin.Edit') }}</a>
                                      @endif

                                      @if (auth('user')->user()->has_permission('delete-roles'))
                                        <a class="dropdown-item" href="{{route('dashboard.roles.destroy', $role->id)}}" data-toggle="modal" data-target="#modal-default-{{$role->id}}">{{ trans('admin.Delete') }}</a>
                                      @endif
                                    </div>
                                  </div>
                                  @include('dashboard.partials.delete_confirmation', [
                                    'url' => route('dashboard.roles.destroy', $role->id),
                                    'modal_id'  => 'modal-default-' . $role->id,
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
  // $.fn.dataTable.ext.search.push(
  //     function( settings, data, dataIndex ) {
  //       //id filter
  //       var id = $('#id').val();
  //       if(data[0] === id || id == ''){ var id_status = true } else { var id_status = false};

  //       if(id_status)
  //         return true;

  //       return false;
  //     }
  // );

  // $(document).ready(function () {
  //     // filter
  //     $('#id').on('change', function () {
  //       table1.draw().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //     });
  // });
</script>
@endsection
