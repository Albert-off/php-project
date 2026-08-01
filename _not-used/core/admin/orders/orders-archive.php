<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar.
$user = currentUser();

// Getting all ARCHIVED orders from DB.
$archivedOrders = getAllArchivedOrders();


// --======== DATA PAGINATION ========-- 
// 1. Total count of ARCHIVED orders.
$totalOrders = count($archivedOrders);

// 2. Determine the current page based on the parameter from the URL. 
// If the page is not specified, set the value to 1.
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 3. Set the number of orders on one page and calculate the total number of pages.
$ordersPerPage = 5;
$totalPages = ceil($totalOrders / $ordersPerPage);

// 4. Getting orders for the current page using array_slice(array, start, length, preserve).
$offset = ($currentPage - 1) * $ordersPerPage;
$currentOrders = array_slice($archivedOrders, $offset, $ordersPerPage);

// 5. Output of orders with pagination. We'll use $currentOrders to display the orders.
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
    <main class="main data-list" id="sidebar_orders">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Actived Orders</h2>
            
            <!--============ ORDERS NAV ============-->
            <nav class="orders-nav">
                <ul class="orders-nav__list">
                    <li class="orders-nav__link">
                        <a href="<?= BASE_URL ?>admin/orders/orders.php">
                            Orders List
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/></svg>
                        </a>
                    </li>
                    <li class="orders-nav__link link-active">
                        <a href="<?= BASE_URL ?>admin/orders/orders-archive.php">
                            Archived Orders
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-80q-33 0-56.5-23.5T120-160v-451q-18-11-29-28.5T80-680v-120q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v120q0 23-11 40.5T840-611v451q0 33-23.5 56.5T760-80H200Zm0-520v440h560v-440H200Zm-40-80h640v-120H160v120Zm200 280h240v-80H360v80Zm120 20Z"/></svg>
                        </a>
                    </li>
                    <li class="orders-nav__link">
                        <a href="<?= BASE_URL ?>admin/orders/orders-trash.php">
                            Deleted Orders
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="data-table" id="data-table">
    
                <section class="table__header">
                    <h1>Archived Orders List [<?= $totalOrders ?>]</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search Order...">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Preferred Date</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Unarchive</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            <?php 
                                $index = $offset + 1;
                                foreach($currentOrders as $order): 
                                
                                    // choosing order status .class for css styles
                                    $orderStatusClass = 'not-selected';
    
                                    if ($order['order_status'] === 'CANCELED') { $orderStatusClass = 'canceled'; }
                                    else if ($order['order_status'] === 'NOT STARTED') { $orderStatusClass = 'not-started'; }
                                    else if ($order['order_status'] === 'IN PROGRESS') { $orderStatusClass = 'in-progress'; }
                                    else if ($order['order_status'] === 'COMPLETED') { $orderStatusClass = 'completed'; }
                                ?>
                                <tr id="order-<?= $order['id'] ?>">
                                    <td><?= $index++; ?></td>
                                    <td><?= $order['created_date'] ?></td>
                                    <td><?= $order['firstname'] ?> <?= truncateString($order['lastname'], 8); ?></td>
                                    <td><?= $order['email'] ?></td>
                                    <td><?= $order['phone'] ?></td>
                                    <td><?= $order['date'] ?? '[empty]' ?></td>
                                    <td><span class="ord-status <?= $orderStatusClass ?>"><?= $order['order_status'] ?? 'NOT SELECTED' ?></span></td>
                                    <td>
                                        <a href="
                                            <?= BASE_URL . queryString('admin/orders/view.php', [
                                                'from'  => 'orders-archive',
                                                'page'  => $currentPage,
                                                'index' => $index - 1,
                                                'id'    => $order['id'],
                                            ]); ?>
                                        "
                                        class="view-btn">
                                            View
                                        </a>
                                    </td>
                                    <td><button onclick="unarchiveSelectedOrder(<?= $order['id'] ?>)" class="arc-btn">Unarchive</button></td>
                                    <td><button onclick="softDeleteSelectedOrder(<?= $order['id'] ?>)" class="del-btn">Delete</button></td>
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