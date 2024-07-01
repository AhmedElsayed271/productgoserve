@php
    if(!isset($type))
        $type = "text";

    if(!isset($value))
        $value = null;

    if(!isset($attribute))
        $attribute = '';
@endphp

<div class="form-group">
    <label for="username">{{$label}}</label>
    <input class="{{$class}}" value="{{$value}}" type="{{$type}}" name="{{$name}}" {{$attribute}}>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>

{{-- <div class="col-lg-6">
    @include('components.form.input', [
        'type' => 'text',
        'name' => "name",
        'label' => 'label',
        'value' => 20,
        'attribute' => 'required',
        'class' => 'form-control',
    ])
</div> --}}