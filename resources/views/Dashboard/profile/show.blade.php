@extends('layouts.admin')

@section('title', trans('admin.Profile'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>{{ trans('admin.Profile') }}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Profile') }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle profile-image preview"
                          src="{{$data->getImage()}}"
                          alt="User profile picture" id="page-img" style="width: 200px;">
                    {{-- <h3 class="profile-username text-center">{{$data->name}}</h3>   --}}
                    <br>
                    <br>

                    <form method="POST" action="{{ route('dashboard.upload.image') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="image" id="file" style="margin: 20px 0px;display: none;">
                      <input class="btn btn-success form-control" type="submit" value="{{trans('admin.Save')}}" name="submit">
                    </form>
                </div>  
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- /.col -->
          <div class="col-md-9">
              <div class="card card-info card-outline">
                  <div class="card-header">
                    <h3 class="card-title">
                      {{ trans('admin.Overflow') }}
                    </h3>
                  </div>

                  <div class="card-body">
                      <form action="" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="row" style="margin: 0 !important;">
                          <div class="col-lg-6">
                            @include('components.form.input', [
                                'class' => 'form-control',
                                'name' => "username",
                                'label' => trans('admin.Username'),
                                'value' => isset($data) ? $data->username : old('username'),
                                'attribute' => 'required',
                            ])
                          </div>


                          <div class="col-lg-6">
                            @include('components.form.input', [
                                'class' => 'form-control',
                                'name' => "name",
                                'label' => trans('admin.Name'),
                                'value' => isset($data) ? $data->name : old('name'),
                                'attribute' => 'required',
                            ])
                          </div>

                          <div class="col-lg-6">
                            @include('components.form.input', [
                                'class' => 'form-control',
                                'name' => "password",
                                'label' => trans('admin.Password'),
                                'value' => old('password'),
                            ])
                          </div>

                          <div class="col-md-12">
                            <input type="submit" class="btn btn-success" value="{{trans('admin.Save')}}">
                          </div>

                      </form> {{-- end of form --}}
                  </div>
                </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
              <div class="card card-info card-outline">
                  <div class="card-header">
                    <h3 class="card-title">
                      {{ trans('admin.Activity logs') }}
                    </h3>
                  </div>


                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>#</th>
                        <th>{{ trans('admin.Created by') }}</th>
                        <th>{{ trans('admin.Subject') }}</th>
                        <th>{{ trans('admin.Action') }}</th>
                        <th>{{ trans('admin.Created at') }}</th>
                      </tr>
                      </thead>
                      <tbody>
                          @foreach ($data->Activity_logs as $log)
                              <tr>
                                  <td>{{$log->id}}</td>
                                  <td>{{$log->causer->name}}</td>
                                  <td>{{$log->subject_type}}</td>
                                  <td>{{trans('admin.' . $log->description)}}</td>
                                  <td>{{$log->created_at}}</td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->

                </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
  <script>
      $('.preview').click(function() {
          $('#file').trigger('click')
      });
  
      $('#file').change(function(event) {
          var image = document.getElementById('file');
          image.src = URL.createObjectURL(event.target.files[0]);
          $('#page-img').attr('src', image.src);
          $('#page-img').css('display', 'block');
      });
  </script>
@endsection
