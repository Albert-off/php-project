<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();
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
    <main class="main data-list" id="sidebar_users_create">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Create User</h2>

            <!--============ USERS NAV ============-->
            <nav class="users-nav">
                <ul class="users-nav__list">
                    <li class="users-nav__link">
                        <a href="<?= BASE_URL ?>admin/users/index.php">
                            Users List
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/></svg>
                        </a>
                    </li>
                    <li class="users-nav__link link-active">
                        <a href="<?= BASE_URL ?>admin/users/create.php">
                            Create User
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="reg__container">

                <form class="reg-form" action="../../src/actions/users/reg.php" method="post" enctype="multipart/form-data">
                    <div class="form-wrapper <?= has_error('name'); ?>">
                        <label for="name">Name</label>
                        <input 
                            name="name" 
                            type="text" 
                            placeholder="Name" 
                            value="<?= getOldValue('name'); ?>"
                            required 
                        />
                        <?= display_error('name'); ?>
                    </div>

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

                    <div class="form-wrapper <?= has_error('avatar'); ?> form-upload">
                        <label for="avatar">Profile image</label>
                        <input name="avatar" type="file" />
                        <?= display_error('avatar'); ?>
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

                    <div class="form-wrapper <?= has_error('password-confirmation'); ?>">
                        <label for="password-confirmation">Password</label>
                        <input 
                            name="password-confirmation" 
                            type="password" 
                            placeholder="Password confirmation" 
                            required 
                        />
                        <?= display_error('password-confirmation'); ?>
                    </div>

                    <div class="form-group-wrapper">
                        <div class="form-wrapper">
                            <label for="role">Role</label>
                            <select name="role">
                                <option default value="User">User</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
    
                        <button type="submit" class="reg-btn">
                            Create
                        </button>
                    </div>
                </form>
                
            </div>

        </section>
    </main>

</body>
</html>