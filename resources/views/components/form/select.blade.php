<?php
    if(!isset($display))
        $display = "name";

    if(!isset($attribute))
        $attribute = "";

    if(!isset($id))
        $id = "";

    if(!isset($firstDisabled))
        $firstDisabled = false;
?>

<div class="form-group">
    <label>{{$label}}</label>

    <select class="{{$class}}" name="{{$name}}" id="{{$id}}" {{$attribute}} style="width: 100%;">
        <option value="" selected @disabled($firstDisabled)>{{ trans('admin.Select') }}</option>

        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if ($data[$index] == $select) selected @endif>{{$data[$display]}}</option>
        @endforeach
    </select>

    @error($name)
        <span style="color: red; margin: 20px;">{{ $message }}</span>
    @enderror
</div>

{{-- example
    @include('components.form.select', [
        'collection' => $categories,
        'index' => 'id',
        'select' => isset($data) ? $data->parent_id : old('parent_id'),
        'name' => 'parent_id',
        'label' => trans('admin.Category'),
        'class' => 'form-control select2',
        'id' => '',
        'display'   => 'name'
        'firstDisabled' => true,
        'attribute' => 'required'
    ])
--}}