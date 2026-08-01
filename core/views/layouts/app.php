<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== PRIMARY META TAGS ===============-->
    <meta name="title" content="RingRoadFlooring">
    <meta name="description" content="Elevate Your Space with Elegant, Durable Flooring">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="<?= $this->asset('css/styles.css') ?>">

    <!--=============== FAVICON ===============-->
    <link rel="icon" type="image/svg+xml" href="<?= $this->asset('img/favicon/favicon.svg') ?>" />
    <link rel="icon" type="image/png" href="<?= $this->asset('img/favicon/favicon-96x96.png') ?>" sizes="96x96" />
    <link rel="shortcut icon" href="<?= $this->asset('img/favicon/favicon.ico') ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->asset('img/favicon/apple-touch-icon.png') ?>" />
    <meta name="apple-mobile-web-app-title" content="RRF" />
    <link rel="manifest" href="<?= $this->asset('img/favicon/site.webmanifest') ?>" />

    <title>
        <?= $this->e($title ?? 'Ring Road Flooring') ?>
    </title>
    <!-- htmlspecialchars($title ?? 'Ring Road Flooring') -->
</head>

<body>
    <?php
    // Check if the 'site_visited' cookie exists. If it doesn't — show the preloader
    if (!isset($_COOKIE['site_visited'])):
    ?>
        <div class="loader" id="page-preloader" aria-hidden="true"></div>
    <?php endif; ?>
    <!-- ================ HEADER ================ -->
    <?= $this->insert('components/header') ?>


    <!-- ================ MAIN ================ -->
    <?= $this->section('content') ?>


    <!-- ================ FOOTER ================ -->
    <?= $this->insert('components/footer') ?>


    <!--=============== SCROLL REVEAL ===============-->
    <script src="<?= $this->asset('js/scrollreveal.min.js') ?>"></script>

    <!--=============== MAIN JS ===============-->
    <script src="<?= $this->asset('js/main.js') ?>"></script>
</body>

</html>