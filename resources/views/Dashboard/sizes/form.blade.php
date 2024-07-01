<div class="card-body">
    <div class="row">


        <div class="col-12">
            <div class="form-group">
                <label for="exampleInputEmail1">اسم المقاس</label>
                <input value="{{ old('name',$size->name ?? "") }}" type="text" class="form-control" id="exampleInputEmail1" name="name" placeholder="ادخل اسم المنتج">
            </div>
        </div>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror

    </div>
</div>
