<script>
    $(document).on("click",".fire-test-popup", function(){	
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            async: false,
            method: "get",
            url: "{{route('testPopUp')}}",
            data: {
                // product_id: product_id,
            },
        success: function (data) {
            $('.my-popup .modal-title').html(data.title);
            $('.my-popup .modal-body').html(data.body);
        },
        error: function (data) {
            alert('false');
        }
        });
    })
</script>