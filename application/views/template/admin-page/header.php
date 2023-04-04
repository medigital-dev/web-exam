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

    <!-- datatables -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('plugins/datatables/dataTables.bootstrap5.min.css'); ?>"> -->
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugins/datatables/datatables.min.css'); ?>">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.css" /> -->

    <!-- web-exam -->
    <link rel="stylesheet" href="<?= base_url('plugins/web-exam/style.css'); ?>">

    <title><?= $title; ?></title>
</head>

<body>
    <!-- navbar -->
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars fa-fw"></i>
                </button>
                <a class="navbar-brand me-auto" href="<?= base_url(); ?>">
                    <img src="<?= base_url('assets/images/Web-eXam-bg-white.png'); ?>" alt="Logo Web-eXam" width="30" class="d-inline-block align-text-top">
                    Web-eXam
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($page == 'dashboard') {
                                                    echo 'active';
                                                } ?>" href="<?= base_url('admin'); ?>">
                                <i class="fa-solid fa-gauge fa-fw"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if ($page == 'akun') {
                                                                    echo 'active';
                                                                } ?>" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-users fa-fw"></i>
                                Data Master
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('admin/akunguru'); ?>">Guru</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/akunpd'); ?>">Peserta Didik</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/akunadmin'); ?>">Admin</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/kelas'); ?>">Kelas</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/ruang'); ?>">Ruang</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/mapel'); ?>">Mata Pelajaran</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php if ($page == 'ujian') {
                                                                    echo 'active';
                                                                } ?>" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-pen-to-square fa-fw"></i>
                                Ujian
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="#">Data Ujian</a></li>
                                <li><a class="dropdown-item" href="#">Jadwal</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-school fa-fw"></i>
                                Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-gears fa-fw"></i>
                                Pengaturan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tombolLogout" href="<?= base_url('logout'); ?>">
                                <i class="fa-solid fa-right-from-bracket fa-fw"></i>
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
                <span class="navbar-text text-white mx-auto text-center lh-1"><span class="mb-0 fs-3 lh-1" id="jam"></span><br><span class="small mb-0 lh-1"><?= $jamTanggal; ?></span></span>
            </div>
        </nav>
    </section>