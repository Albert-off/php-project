<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();

// Getting all users from DB.
$users = getAllUsers();


// --======== DATA PAGINATION ========-- 
// 1. Total count of users.
$totalUsers = count($users);

// 2. Determine the current page based on the parameter from the URL. 
// If the page is not specified, set the value to 1.
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 3. Set the number of users on one page and calculate the total number of pages.
$usersPerPage = 5;
$totalPages = ceil($totalUsers / $usersPerPage);

// 4. Getting users for the current page using array_slice(array, start, length, preserve).
$offset = ($currentPage - 1) * $usersPerPage;
$currentUsers = array_slice($users, $offset, $usersPerPage);

// 5. Output of users with pagination. We'll use $currentUsers to display the users.
// $index = $offset + 1;
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
    <main class="main data-list" id="sidebar_users_list">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Users</h2>

            <!--============ USERS NAV ============-->
            <nav class="users-nav">
                <ul class="users-nav__list">
                    <li class="users-nav__link link-active">
                        <a href="<?= BASE_URL ?>admin/users/index.php">
                            Users List
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/></svg>
                        </a>
                    </li>
                    <li class="users-nav__link">
                        <a href="<?= BASE_URL ?>admin/users/create.php">
                            Create User
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M720-400v-120H600v-80h120v-120h80v120h120v80H800v120h-80Zm-360-80q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm80-80h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0-80Zm0 400Z"/></svg>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="data-table" id="data-table">
    
                <section class="table__header">
                    <h1>Users List [<?= $totalUsers ?>]</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search User...">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $index = 1;
                                foreach($users as $usr): ?>
                                <tr>
                                    <td><?= $index++; ?></td>
                                    <td>
                                        <div>
                                            <img src="<?= BASE_URL . $usr['avatar'] ?>" alt="">
                                            <span><?= $usr['name'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= $usr['email'] ?></td>
                                    <td><strong><?= $usr['role'] ?></strong></td>
                                    <td><a href="<?= BASE_URL ?>admin/users/edit.php?id=<?= $usr['id'] ?>" class="edit-btn">Edit</a></td>
    
                                    <?php if($usr['role'] === 'Admin'): ?>
                                        <td><button class="del-btn" style="pointer-events: none; opacity: .6;">Delete</button></td>
                                    <?php else: ?>
                                        <td><button class="del-btn">Delete</button></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </section>
                
            </div>

            <!--============ PAGINATION ============-->
            <?php require_once SITE_ROOT . "/includes/data-table-pagination.php"; ?>
        </section>
    </main>

</body>
</html>