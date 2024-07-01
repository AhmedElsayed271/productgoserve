<div class="form-group clearfix">
    <div class="">
        <input type="checkbox" id="{{$tag}}" name="{{$name}}" value="{{$value}}" {{$attribute}}>
        <label for="{{$tag}}">{{$label}}</label>
    </div>
</div>

{{-- example
<div class="col-lg-6">
    @include('components.form.checkbox', [
        'class' => 'form-control',
        'name' => 'permissions[]',
        'label' => 'label',
        'value' => $value . '-' . $key,
        'attribute' => 'checked',
        'tag' => $value . '-' . $key,
    ])
</div> --}}