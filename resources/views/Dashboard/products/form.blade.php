<div class="card-body">
    <div class="row">


        <div class="col-12">
            <div class="form-group">
                <label for="exampleInputEmail1">اسم المنتج</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name"
                    placeholder="ادخل اسم المنتج" value="{{ old('name', $product->name ?? '') }}">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>أختر المقاس</label>
                <select class="select2" multiple="multiple" name="sizes[]" data-placeholder="Select a State"
                    style="width: 100%;">

                    @foreach ($sizes as $size)
                        <option
                            @isset($product) @if (in_array($size->id, $product->sizes->pluck('id')->toArray())) selected @endif @endisset
                            value="{{ $size->id }}">{{ $size->name }}</option>
                    @endforeach

                </select>
            </div>
            @error('sizes')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


    </div>
</div>
