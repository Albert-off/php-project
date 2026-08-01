<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();

// Getting selected user data from db.
$userId;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = $_GET['id'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {ID} IN YOUR URL!";
}
$userData = getUserById($userId);
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
    <main class="main data-list">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">

            <h2>Edit User</h2>
            
            <div class="reg__container">

                <form class="reg-form" action="../../src/actions/users/edit-user.php" method="post" enctype="multipart/form-data">
                    <input name="userId" type="hidden" value="<?= $userId ?>">
                    
                    <input name="originalEmail" type="hidden" value="<?= $userData['email'] ?>">

                    <input name="originalAvatarPath" type="hidden" value="<?= $userData['avatar'] ?>">
                
                    <div class="form-wrapper <?= has_error('name'); ?>">
                        <label for="name">Name</label>
                        <?php $oldName = getOldValue('name'); ?>
                        <input 
                            name="name" 
                            type="text" 
                            placeholder="Name" 
                            value="<?= empty($oldName) ? $userData['name'] : $oldName; ?>"
                            required 
                        />
                        <?= display_error('name'); ?>
                    </div>

                    <div class="form-wrapper <?= has_error('email'); ?>">
                        <label for="email">Email</label>
                        <?php $oldEmail = getOldValue('email'); ?>
                        <input 
                            name="email" 
                            type="email" 
                            placeholder="Email Address" 
                            value="<?= empty($oldEmail) ? $userData['email'] : $oldEmail; ?>" 
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
                                <option <?php if($userData['role'] === 'User') echo 'selected'; ?> default value="User">User</option>
                                <option <?php if($userData['role'] === 'Admin') echo 'selected'; ?> value="Admin">Admin</option>
                            </select>
                        </div>
    
                        <button type="submit" class="reg-btn">
                            Update
                        </button>
                    </div>
                </form>
                
            </div>

            <a href="<?= BASE_URL ?>admin/users/index.php" class="btn-link"
               style="margin-left: auto; margin-top: .5rem;">
                Back
            </a>
        </section>
    </main>

</body>
</html>