<?php
    if(!isset($display))
        $display = "name";

    if(!isset($attribute))
        $attribute = "";

    if(!isset($id)){
        $id = "";
    }
?>

<div class="form-group">
    <label>{{$label}}</label>
    <select multiple name="{{$name}}" id="{{$id}}" class="{{$class}}" style="width: 100%;">
        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if (in_array($data[$index], $selectArr)) selected @endif>{{$data[$display]}}</option>
        @endforeach
    <select>

    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>


{{-- example
    @include('components.form.select', [
        'class'  => 'form-control select2 mainUnitIdDev',
        'id'  => '',
        'attribute'  => 'required',
        'collection'  => $users,
        'selectArr'  => $sub_unit_ids,
        'index'  => 'id',
        'name'  => 'sub_unit_ids[]',
        'label'  => trans('admin.sub units'),
        'display'  => 'actual_name',
    ])
--}}