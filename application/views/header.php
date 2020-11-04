<? defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="msapplication-TileColor" content="#212529">
    <meta name="msapplication-TileImage" content="<?= base_url('assets/icons/ms-icon-144x144.png') ?>">
    <meta name="theme-color" content="#212529">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/icons/apple-icon-57x57.png') ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('assets/icons/apple-icon-60x60.png') ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/icons/apple-icon-72x72.png') ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/icons/apple-icon-76x76.png') ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/icons/apple-icon-114x114.png') ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('assets/icons/apple-icon-120x120.png') ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/icons/apple-icon-144x144.png') ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('assets/icons/apple-icon-152x152.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/icons/apple-icon-180x180.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/icons/android-icon-192x192.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/icons/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/icons/favicon-96x96.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/icons/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= base_url('assets/icons/manifest.json') ?>">

    <title>CATicket</title>
    <base href="<?= base_url(); ?>">

    <link href="<?= base_url('vendor/twbs/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('vendor/components/font-awesome/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css?v=' . VERSION) ?>" rel="stylesheet">

    <? if (isset($page)) : ?>
        <? if ($page == "login") : ?>
            <link href="<?= base_url('assets/css/login.css?v=' . VERSION) ?>" rel="stylesheet">
        <? endif; ?>
    <? endif; ?>

</head>

<body>
    <? if (isset($page)) : ?>
        <? if ($page != "login") : ?>
            <input type="hidden" id="tokendata" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

            <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-nav-dark mb-3">
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url(); ?>">
                        <i class="fas fa-paw text-danger"></i>
                        CATICKET <span class="badge badge-pill badge-warning" style="font-size: 10px;">Beta</span>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link <?= (isset($page) ? ($page == "home" ? "active" : "") : "") ?> " href="<?= base_url(); ?>">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= (isset($page) ? ($page == "nuevoticket" ? "active" : "") : "") ?>" href="<?= base_url("main/nuevo"); ?>">Nuevo Ticket</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?= (isset($page) ? ($page == "tickets" ? "active" : "") : "") ?>" href="<?= base_url("main/tickets"); ?>">Tickets</a>
                            </li>

                            <!--li class="nav-item">
                                <a class="nav-link <?= (isset($page) ? ($page == "estadisticas" ? "active" : "") : "") ?>" href="<?= base_url(); ?>">Estadisticas</a>
                            </li-->

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i> <?= $this->session->userdata('user') ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?= base_url('/user/logout'); ?>"><i class="fas fa-sign-out-alt"></i> Cerrar sesion</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <? endif; ?>
    <? endif; ?>