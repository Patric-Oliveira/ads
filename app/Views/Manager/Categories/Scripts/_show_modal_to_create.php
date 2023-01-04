<script>
    $(document).on('click', '#createCategoryBtn', function() {

        $('.modal-title').text('Criar Categoria');
        $('#categoryModal').modal('show');
        $('input[name="id"]').val('');
        $('input[name="_method"]').remove();
        $('#categories-form')[0].reset();
        $('#categories-form').attr('action', '<?php echo route_to('categories.create'); ?>');
        $('#categories-form').find('span.error-text').text('');

        var url = '<?php echo route_to('categories.parents'); ?>';

        $.get(url, function(response) {

            /*window.refreshCSRFToken(response.token);*/
            $('#boxParents').html(response.parents);

        }, 'json');
    });
</script>