<!-- Iniciando o datatable -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
            },
            ajax: '<?php echo route_to('categories.get.all'); ?>',
            columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'actions'
                },
            ],
        });
    });
</script>