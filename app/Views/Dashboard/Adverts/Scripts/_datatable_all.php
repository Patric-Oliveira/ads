<!-- Iniciando o datatable -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [],
            "deferRender": true,
            "processing": true,
            "responsive": true,
            "pagingType": "numbers",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json",
            },
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