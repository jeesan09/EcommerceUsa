<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).ready(function() {
        $(document).on('change', '#sortby', function() {
            var sort_by_type =  $(this).val();
              // alert(sort_by_type);
            $.ajax({
                type: "GET",
                url: "/product/soft/by",
                data: {
                    sort_by_type: sort_by_type,
                },
                success: function(res) {
                    $('.products').html(res);
                }
            });

        });

    });


</script>

