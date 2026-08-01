<?php
session_start(); 

require_once "path.php"; 

require_once SITE_ROOT . "/src/helpers.php";

// Allow or deny access to an authenticated user.
checkGuest();

// If access is denied than $user = false to prevent warning.
$user = false;
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
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/styles.css">

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
    <!-- ================ HEADER ================ -->
    <?php require_once "includes/header.php"; ?>


    <!-- ================ MAIN ================ -->
    <main class="main">
        
        <!--==================== AUTH ====================-->
        <section class="auth section">
            <div class="auth__container container">
                <h1>Auth</h1>

                <form class="auth-form" action="core/src/actions/auth.php" method="post">

                    <?php if(hasMessage('error')): ?>
                        <div class="notice-error"><?= getMessage('error'); ?></div>
                    <?php endif; ?>

                    <div class="form-wrapper <?= has_error('email'); ?>">
                        <label for="email">Email</label>
                        <input 
                            name="email" 
                            type="email" 
                            placeholder="Email Address" 
                            value="<?= getOldValue('email'); ?>"
                            required 
                        />
                        <?= display_error('email'); ?>
                    </div>
                    <div class="form-wrapper <?= has_error('password'); ?>">
                        <label for="password">Password</label>
                        <input 
                            name="password" 
                            type="password" 
                            placeholder="Password" 
                            required 
                        />
                        <?= display_error('password'); ?>
                    </div>
                    <button type="submit" class="button auth-btn">
                        Login
                    </button>
                </form>
            </div>
        </section>
    </main>


    <!-- ================ FOOTER ================ -->
    <?php require_once "includes/footer.php"; ?>


    <!--=============== SCROLL REVEAL ===============-->
    <script src="<?= BASE_URL ?>assets/js/scrollreveal.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="<?= BASE_URL ?>assets/js/main.js"></script>
</body>
</html>