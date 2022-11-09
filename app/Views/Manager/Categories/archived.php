<?php echo $this->extend('Manager/Layout/main.php') ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Core datatables CSS (includes Bootstrap)-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadoww-lg">
                <div class="card-header">
                    <h5><?php echo $title ?? ''; ?></h5>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm mt-2 mb-4" href="<?php echo route_to('categories'); ?>">Voltar</a>
                    <table class="table table-borderless table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Core datatables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<!-- Core SweetAlert2 JS -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Includes -->
<?php echo $this->include('Manager/Categories/Scripts/_datatable_all_archived'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_recover_category'); ?>
<?php echo $this->include('Manager/Categories/Scripts/_delete_category'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>