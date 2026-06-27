<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) . ' — TaskManager' : 'TaskManager' ?></title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <!-- FontAwesome 7 -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/fontawesome-free-7.2.0-web/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/responsive.css') ?>">
</head>
<body class="<?= isset($page_class) ? htmlspecialchars($page_class) : '' ?>">
    
<!-- ===== FLASH MESSAGES ===== -->
 <?php include('navbar.php')?>


<!-- ===== FLASH MESSAGES ===== -->
<div class="container mt-3" id="flash-container">
<?php
$flash_success = $this->session->flashdata('success');
$flash_error   = $this->session->flashdata('error');
$flash_warning = $this->session->flashdata('warning');

if ($flash_success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check me-2"></i><?= htmlspecialchars($flash_success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($flash_error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i><?= htmlspecialchars($flash_error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if ($flash_warning): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-triangle-exclamation me-2"></i><?= htmlspecialchars($flash_warning) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
</div>
<!-- ===== MAIN CONTENT START ===== -->
