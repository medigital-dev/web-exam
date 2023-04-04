<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url('assets/images/Web-eXam-icon.png'); ?>" type="image/x-icon">

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="<?= base_url('plugins/bootstrap/css/bootstrap.min.css'); ?>">

    <!-- fontawesome -->
    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome/css/all.min.css'); ?>">

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="<?= base_url('plugins/sweetalert2/dist/sweetalert2.min.css'); ?>">

    <!-- Animate -->
    <link rel="stylesheet" href="<?= base_url('plugins/animate-style/animate.min.css'); ?>">

    <!-- web-exam -->
    <link rel="stylesheet" href="<?= base_url('plugins/web-exam/sidebars.css'); ?>">

    <title><?= $title; ?></title>
</head>

<body>
    <!-- navbar -->
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/images/Web-eXam-bg-white.png'); ?>" alt="Logo Web-eXam" width="30" class="d-inline-block align-text-top">
                    Web-eXam
                </a>
                <span class="navbar-text text-white ms-auto text-center lh-1"><span class="mb-0 fs-3 lh-1" id="jam"></span><br><span class="small mb-0 lh-1"><?= $tanggalSekarang; ?></span></span>
            </div>
        </nav>
    </section>