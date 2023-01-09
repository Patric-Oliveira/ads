<!-- Iniciando o datatable -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            ajax: '<?php echo route_to('get.all.my.adverts'); ?>',
            columns: [{
                    data: 'image'
                },
                {
                    data: 'code'
                },
                {
                    data: 'title'
                },
                {
                    data: 'category'
                },
                {
                    data: 'is_published'
                },
                {
                    data: 'address'
                },
                {
                    data: 'actions'
                },
            ],
        });
    });
</script>