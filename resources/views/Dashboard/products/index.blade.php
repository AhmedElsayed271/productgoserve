@extends('layouts.admin')

@section('title', trans('admin.products'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ trans('admin.product') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">{{ trans('admin.Home') }}</a> /
                            {{ trans('admin.products') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('admin.filter') }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-lg-6">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="exampleSelectBorder">اختر المقاس </label>
                                <select id="sizes" name="size" class="custom-select form-control-border"
                                    id="exampleSelectBorder">
                                    <option value=""></option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->name }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>

    

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">احصائيات</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">
          
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>عدد المنتجات</label>
                          <input  id="countofproduct" type="text" class="form-control" placeholder="" disabled>
                        </div>
                      </div>
                    </div>
         
  

  
     
  
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            <div class="card">
                <div class="card-header">
                    @if (auth('user')->user()->has_permission('create-products'))
                        <a href="{{ route('dashboard.products.create') }}" type="button"
                            class="btn btn-info">{{ trans('admin.Add') }}</a>
                    @else
                        <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
                    @endif
                    @if (auth('user')->user()->has_permission('create-products'))
                        <a href="{{ route('dashboard.products.import.products.page') }}" type="button"
                            class="btn btn-info">{{ trans('admin.import_product') }}</a>
                    @else
                        <a href="#" type="button"
                            class="btn btn-info disabled">{{ trans('admin.import_product') }}</a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('admin.Name') }}</th>
                                <th>{{ trans('admin.sizes') }}</th>
                                <th>{{ trans('admin.Created at') }}</th>
                                <th>{{ trans('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($products as $product)
                      <tr>
                          <td>{{$loop->iteration}}</td>

                          <td><img style="width: 100px;" src="{{ asset('uploads/images/' . $product->photo) }}" alt=""></td>
                          <td>{{$product->name}}</td>
                          <td>{{$product->description}}</td>
                          <td>
                              @foreach ($product->sizes as $size)
                                {{ $size->name  }} @if ($loop->index != count($product->sizes) - 1) , @endif 
                              @endforeach
                          </td>
                          <td>{{$product->created_at}}</td>
                          <td>
                              <div class="btn-group">
                                <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                </button>
                                <div class="dropdown-menu" role="menu">
                                  @if (auth('user')->user()->has_permission('update-products'))
                                    <a class="dropdown-item" href="{{route('dashboard.products.edit',$product->id)}}">{{ trans('admin.Edit') }}</a>
                                  @endif

                                  @if (auth('user')->user()->has_permission('delete-products'))
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default-{{$product->id}}">{{ trans('admin.Delete') }}</a>
                                  @endif
                                </div>
                              </div>

                              @include('Dashboard.partials.delete_confirmation', [
                                'url' => route('dashboard.products.destroy',$product->id),
                                'modal_id'  => 'modal-default-' . $product->id,
                              ])
                          </td>
                      </tr>
                  @endforeach --}}
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
        var table = $("#table").DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                "url": "{{ route('dashboard.products.index') }}",
                "data": function(d) {
                    d.search = $('#sizes').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name'
                },
                {
                    data: 'size',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'created_at',

                },

                {
                    data: 'actions',
                    orderable: false,
                    searchable: false

                },
            ]


        });
        
        $('#sizes').change(function() {


            $('#countofproduct').val(table.ajax.json().count);
            console.log(table.ajax.json().count);
            table.ajax.reload();
            console.log(table.ajax.json().count);

   
         
        });

        table.on('draw.dt', function() {
            $('#countofproduct').val(table.ajax.json().count);
            console.log(table.ajax.json().count);

        });

    </script>

@endsection
