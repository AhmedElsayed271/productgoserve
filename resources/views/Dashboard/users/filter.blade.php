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
            @include('components.form.select', [
                'collection' => $roles,
                'index' => 'name',
                'select' => '',
                'name' => 'role',
                'label' => trans('admin.Roles'),
                'class' => 'form-control select2',
                'firstDisabled' => false,
                'id' => 'role'
            ])
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>