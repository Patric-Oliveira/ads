<script>
    $(document).on('click', '#deleteCategoryBtn', function(e) {

        e.preventDefault();

        var id = $(this).data('id');

        var url = '<?php echo route_to('categories.delete'); ?>';

        Swal.fire({
            title: '<?php echo lang('App.delete_confirmation'); ?>',
            text: '<?php echo lang('App.info_delete_confirmation'); ?>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?php echo lang('Categories.btn_confirmed_delete'); ?>',
            cancelButtonText: '<?php echo lang('Categories.btn_cancel'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {

                $.post(url, {
                    '<?php echo csrf_token(); ?>': $('meta[name="<?php echo csrf_token(); ?>"]').attr('content'),
                    _method: 'DELETE', // Spoofing do request
                    id: id
                }, function(response) {
                    window.refreshCSRFToken(response.token);
                    toastr.success(response.message);
                    $('#dataTable').DataTable().ajax.reload(null, false);
                }, 'json').fail(function() {
                    toastr.error('Error Backend');
                });

            }
        })
    });
</script>