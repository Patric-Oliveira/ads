<?php echo $this->extend('Manager/Layout/main.php') ?>

<?= $this->section('title') ?>
<?php echo lang('Plans.title_archived'); ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Core datatables CSS (includes Bootstrap)-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadoww-lg">
                <div class="card-header">

                    <h5><?php echo lang('Plans.title_archived'); ?></h5>
                    
                </div>

                <div class="card-body">
                    <a class="btn btn-info btn-sm mt-2 mb-4" href="<?php echo route_to('plans'); ?>"><?php echo lang('Plans.btn_back'); ?></a>
                    <table class="table table-borderless table-striped" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col"><?php echo lang('Plans.label_code'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_name'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_is_highlighted'); ?></th>
                                <th scope="col"><?php echo lang('Plans.label_details'); ?></th>
                                <th scope="col"><?php echo lang('Plans.btn_actions'); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->include('Manager/Plans/_modal_plan'); ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Core datatables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<!-- Core SweetAlert2 JS -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Includes -->
<?php echo $this->include('Manager/Plans/Scripts/_datatable_all_archived'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_recover_plan'); ?>
<?php echo $this->include('Manager/Plans/Scripts/_delete_plan'); ?>

<script>
    function refreshCSRFToken(token) {
        $('[name="<?php echo csrf_token(); ?>"]').val(token);
        $('meta[name="<?php echo csrf_token(); ?>"]').attr('content', token);
    }
</script>
<?= $this->endSection() ?>