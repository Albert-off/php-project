<?php
session_start();

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();

// get home_page_content db data
$aboutUsContent = returnAboutUsPageContent();
?>

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
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/admin-styles.css">

    <!--=============== JS ===============-->
    <script type="text/javascript" src="<?= BASE_URL ?>assets/js/admin.js" defer></script>

    <!--=============== FAVICON ===============-->
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>assets/img/favicon/favicon.svg" />
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>assets/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= BASE_URL ?>assets/img/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="RRF" />
    <link rel="manifest" href="<?= BASE_URL ?>assets/img/favicon/site.webmanifest" />

    <title>RingRoadFlooring</title>
</head>
<body>
    <!-- ================ ADMIN SIDEBAR ================ -->
    <?php require_once SITE_ROOT . "/includes/admin-sidebar.php"; ?>
    

    <!-- ================ MAIN ================ -->
    <main class="main" id="sidebar_pages_aboutus">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>About Us</h2>

            <div class="aboutus-content__grid">
                
                <div class="aboutus-content__group">
                    <textarea id="aboutus-title" maxlength="70" oninput="autoResize(this)" rows="1"><?= $aboutUsContent['aboutus_title'] ?></textarea>
                    <textarea id="aboutus-descr-1" maxlength="2000" oninput="autoResize(this)"><?= $aboutUsContent['aboutus_descr_1'] ?></textarea>
                </div>

                <div class="aboutus-content__group">
                    <textarea id="aboutus-subtitle" maxlength="70" oninput="autoResize(this)" rows="1"><?= $aboutUsContent['aboutus_subtitle'] ?></textarea>
                    <textarea id="aboutus-descr-2" maxlength="2000" oninput="autoResize(this)"><?= $aboutUsContent['aboutus_descr_2'] ?></textarea>
                </div>
            </div>

            <button onclick="saveAboutUs(true)">Save</button>
        </section>

    </main>

</body>
</html>