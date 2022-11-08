<?php echo $this->extend('Manager/Layout/main.php') ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1><?php echo $title ?? ''; ?></h1>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php echo $title ?? ''; ?>
<?= $this->endSection() ?>