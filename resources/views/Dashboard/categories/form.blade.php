<div class="card-body">
    <div class="row">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="col-lg-6">
                @include('components.form.input', [
                    'type' => 'text',
                    'class' => 'form-control',
                    'attribute' => 'required',
                    'name' => "{$localeCode}[name]",
                    'value' => isset($data) ? $data->translate($localeCode)->name : old('name') ,
                    'label' => trans('admin.name'). " ({$properties['native']})",
                ])
            </div>
        @endforeach

        <div class="col-lg-6">
            @include('components.form.select', [
                'collection' => $categories,
                'index' => 'id',
                'select' => isset($data) ? $data->parent_id : old('parent_id'),
                'name' => 'parent_id',
                'label' => trans('admin.Category'),
                'class' => 'form-control select2',
            ])
        </div>
    </div>
</div>