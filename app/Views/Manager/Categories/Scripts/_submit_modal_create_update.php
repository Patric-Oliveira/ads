<script>
    $('#categories-form').submit(function(e) {

        e.preventDefault();

        var form = this;

        $.ajax({

            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'JSON',
            contentType: false,
            beforeSend: function() {
                $(form).find('span.error-text').text('');
            },
            success: function(response) {

                window.refreshCSRFToken(response.token);

                if (response.success == false) {
                    toastr.error('Verifique os Erros e Tente Novamente');
                    $.each(response.errors, function(field, value) {
                        $(form).find('span.' + field).text(value);
                    })
                    return;
                }

                toastr.success(response.message);
                $('#categoryModal').modal('hide');
                $(form)[0].reset();
                $('#dataTable').DataTable().ajax.reload(null, false);
                $('.modal-title').text('Criar Categoria');
                $(form).attr('action', '<?php echo route_to('categories.create'); ?>');
                $(form).find('input[name="id"]').val('');
                $(['name=_method']).remove();
            },
            error: function() {
                alert('Error Backend');
            },
        });
    });
</script>