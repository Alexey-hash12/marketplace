<script>
    const form = document.getElementById('myForm');

    $('.form-sort').click(function () {
        $('#sort_type_input').val($(this).data('name'));
        $("#sort_value_input").val($(this).data('value'));
        form.submit();
    })
</script>

<script>
    $('.delete-btn').click(function () {

        const id = $(this).data('id');
        $('#deleteTokenId').val(id);
    })

    $('.warning-btn').click(function () {
        const id = $(this).data('id');
        $('#closeId').val(id);
    })
    $('.primary-btn').click(function () {
        const id = $(this).data('id');
        $('#productId').val(id);
    })
</script>
