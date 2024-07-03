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
                    <div class="col-lg-6">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="exampleSelectBorder">اختر الاسم </label>
                                <select id="searchName" name="name" class="custom-select form-control-border"
                                    id="exampleSelectBorder">
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->name }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="exampleSelectBorder">اختر اسم المنتج </label>
                                <input type="text" class="form-control" id="nameProduct" name="name"
                                    placeholder="ادخل اسم المنتج">
                            </div>

                            <button type="submit" id="searchProduct" class="btn btn-primary">بحث</button>

                        </div>
                    </div> --}}
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
                                    <input id="countofproduct" type="text" class="form-control" placeholder="" disabled>
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
                    @if (auth('user')->user()->has_permission('delete-products'))
                        <a href="#" type="button" id="deletebyid"
                            class="btn btn-danger">{{ trans('admin.Delete') }}</a>
                    @else
                        <a href="#" type="button"
                            class="btn btn-danger disabled">{{ trans('admin.delete') }}</a>
                    @endif
                    @if (auth('user')->user()->has_permission('delete-products'))
                        <a href="{{ route('dashboard.products.destroy.all') }}" type="button"
                            class="btn btn-danger">{{ trans('admin.delete_all') }}</a>
                    @else
                        <a href="#" type="button"
                            class="btn btn-danger disabled">{{ trans('admin.delete_all') }}</a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><input type="checkbox" id="selectAllProduct" /></th>

                                <th>{{ trans('admin.Name') }}</th>
                                <th>{{ trans('admin.sizes') }}</th>
                                <th>{{ trans('admin.Created at') }}</th>
                                <th>{{ trans('admin.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

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
            serverSide: true,
            ajax: {
                "url": "{{ route('dashboard.products.index') }}",
                "data": function(d) {
                    d.size = $('#sizes').val();
                    d.name = $('#searchName').val();
                }
            },
            columns: [

                {
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'checkboxDelete',
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
                    orderable: false,
                    searchable: false

                },

                {
                    data: 'actions',
                    orderable: false,
                    searchable: false

                },
            ]


        });

        $('#sizes').change(function() {


            $('#countofproduct').val(table.settings()[0].json.recordsFiltered);

            table.ajax.reload();



        });

        $('#searchName').change(function() {


           

            table.ajax.reload();

            console.log($('#searchName').val());



        });
        // $('#searchProduct').click(function() {


        //     $('#countofproduct').val(table.settings()[0].json.recordsFiltered);

        //     table.ajax.reload();

        //     console.log($('#nameProduct').val())



        // });


        table.on('draw.dt', function() {
            $('#countofproduct').val(table.settings()[0].json.recordsFiltered);
        });




        
    </script>

    <script>
        $(document).ready(function() {

            $('#selectAllProduct').click(function() {
                inputs = $(".checkboxDelete");
                inputs.prop('checked', $(this).prop('checked'));

            })

            $('#deletebyid').click(function(e) {

                e.preventDefault();

                inputs = $(".checkboxDelete:checked:enabled");

                var ids = [];

                inputs.each(function() {
                    ids.push($(this).val());
                });

                if (ids.length > 0) {
                    $.ajax({

                        url: "{{ route('dashboard.products.destroy.by.id') }}",
                        type: 'POST',
                        data: {
                            'ids': ids,
                            '_token': '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(data) {
                            //    $.each(ids, function (index,value) {

                            //         $('#row-' + value).remove();

                            //    })


                            location.reload();

                        },
                        error: function(request, error) {
                            console.log('Data: ' + request);
                        }
                    });
                }


            })

        });
    </script>

@endsection
