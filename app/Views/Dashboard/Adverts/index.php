<?php echo $this->extend('Dashboard/Layout/main.php') ?>

<?= $this->section('title') ?>
<?php echo $title ?? 'Listando Meus Anúncios'; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
        <!-- Row Start -->
        <div class="row">

            <?php echo $this->include('Dashboard/Layout/_sidebar') ?>

            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <!-- Recently Favorited -->
                <div class="widget dashboard-container my-adslist">
                    <h3 class="widget-header">Listando Meus Anúncios</h3>

                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="createAdvertBtn" class="btn btn-main-sm add-button float-right mb-2"><i class="fa fa-plus"></i> Criar</button>
                        <table class="table table-borderless table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th scope="col">Imagem</th>
                                    <th scope="col" class="none">Código</th>
                                    <th scope="col" class="all">Título</th>
                                    <th scope="col" class="none text-center">Categoria</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="none">Onde</th>
                                    <th scope="col" class="all text-center">Ações</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>