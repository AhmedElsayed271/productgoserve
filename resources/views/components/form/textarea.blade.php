@php
    if(!isset($key))
        $key = '';
@endphp

<div class="col-md-12">
    <div class="form-group">
        <label>{{$label}}</label>
        <textarea class="{{$class}}" id="{{$key}}" name="{{$name}}" {{$attribute}}>{{$value}}</textarea>
        @error($name)
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
        @enderror
    </div>
</div>


<script>
    $(function () {
        // Summernote
        $('#{{$key}}').summernote({
            height: ($(window).height() - 300),
            callbacks: {
                onImageUpload: function(files) {
                    for(var i = files.length -1; i >= 0 ;i--){
                        uploadFile(files[i]);
                    }
                }
            }
        })

        function uploadFile(file) {
            var formData = new FormData();
            formData.append('file', file);
            $("#loading-image").modal("show");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                type: "post",
                enctype: 'multipart/form-data',
                url: "{{ route('dashboard.summernote_upload_image') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (url) {
                    var image = $('<img>').attr('src', url);
                    $('#{{$key}}').summernote("insertNode", image[0]);
                    $("#loading-image").modal("hide");
                },
                error: function (url) {
                    $("#loading-image").modal("hide");
                    alert('false');
                },
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener(
                    "progress",
                    function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                        percent = Math.ceil((position / total) * 100);
                        }
                        //update progressbar
                        $("#image-progress" + " .progress-bar").css(
                            "width",
                            +percent + "%"
                        );
                        $("#image-progress" + " .progress-bar").text(percent + "%");
                    },
                    true
                    );
                }
                return xhr;
            },
            });
        }

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>

{{--
    @include('components.form.textarea', [
        'class' => 'form-control',
        'name' => "name",
        'key' => 'text_1',
        'label' => trans('admin.text'),
        'value' => isset($data) ? $data->text : old('text'),
        'attribute' => 'required',
    ])
--}}