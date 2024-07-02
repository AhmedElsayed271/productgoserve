<div class="btn-group">
    <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
    </button>
    <div class="dropdown-menu" role="menu">
      @if (auth('user')->user()->has_permission('update-products'))
        <a class="dropdown-item" href="{{route('dashboard.products.edit',$id)}}">{{ trans('admin.Edit') }}</a>
      @endif

      @if (auth('user')->user()->has_permission('delete-products'))
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default-{{$id}}">{{ trans('admin.Delete') }}</a>
      @endif
    </div>
  </div>

  @include('dashboard.partials.delete_confirmation', [
    'url' => route('dashboard.products.destroy',$id),
    'modal_id'  => 'modal-default-' . $id,
  ])