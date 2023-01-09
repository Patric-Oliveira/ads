<?php echo $this->extend('Dashboard/Layout/main.php') ?>

<?= $this->section('title') ?>
<?php echo $title ?? 'Principal'; ?>
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
                        <h3 class="widget-header">Listando os Anúncios</h3>

                    </div>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </section>
    
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>