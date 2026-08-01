<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();

// get fl_install_page_content db data
$flInstallContent = returnFlInstallPageContent();
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
    <main class="main" id="sidebar_pages_fl_install">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Flooring Installation</h2>

            <div class="fl-install-content__grid">

                <div class="fl-install-content__group">
                    <textarea id="fl-install-title" maxlength="70" oninput="autoResize(this)" rows="1"><?= $flInstallContent['fl_install_title'] ?></textarea>
                    <textarea id="fl-install-descr-1" maxlength="2000" oninput="autoResize(this)"><?= $flInstallContent['fl_install_descr_1'] ?></textarea>
                </div>

                <div class="fl-install-banner__group">
                    <div class="upload-container">
                        <figure class="upload-image-container">
                            <img id="choosen-img-1" src="<?= BASE_URL ?>/uploads/home-images/<?= $flInstallContent['fl_install_img_url'] ?>" alt="">
                            <figcaption id="file-name-1">
                                <?= $flInstallContent['fl_install_img_url'] ?? 'Demo File Name' ?>
                            </figcaption>
                        </figure>

                        <input type="file" id="upload-button-1" accept="image/*">
                        <label for="upload-button-1">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80v-80h640v80H160Zm200-160v-280H200l280-360 280 360H600v280H360Zm80-80h80v-280h76L480-750 364-600h76v280Zm40-280Z"/></svg>
                            Choose a photo
                        </label>
                    </div>
                </div>

                <div class="fl-install-content__group span-2">
                    <textarea id="fl-install-subtitle" maxlength="70" oninput="autoResize(this)" rows="1"><?= $flInstallContent['fl_install_subtitle'] ?></textarea>
                    <textarea id="fl-install-descr-2" maxlength="2000" oninput="autoResize(this)"><?= $flInstallContent['fl_install_descr_2'] ?></textarea>
                </div>
            </div>

            <button onclick="saveFlInstall(true)">Save</button>
        </section>

    </main>

</body>
</html>