<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();


// --======== GET URL VALUES ========--
// Getting sended from value to go back at the right orders data-table.
$returnLink = '';

if (isset($_GET['from']) && !empty($_GET['from'])) {

    switch ($_GET['from']) {
        case 'orders':
            $returnLink = 'admin/orders/orders.php';
            break;
        case 'orders-archive':
            $returnLink = 'admin/orders/orders-archive.php';
            break;
        case 'orders-trash':
            $returnLink = 'admin/orders/orders-trash.php';
            break;
        default:
            $returnLink = 'admin/orders/orders.php';
            break;
    }

} else {
    echo "ERROR MESSAGE: THERE IS NO {from} IN YOUR URL!";
}

// Getting sended page value to go back at the right page in data-table.
$dataTablePage;
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $dataTablePage = $_GET['page'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {page} IN YOUR URL!";
}

// Getting sended index value to go back at the right index in data-table.
$orderIndex;
if (isset($_GET['index']) && !empty($_GET['index'])) {
    $orderIndex = $_GET['index'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {index} IN YOUR URL!";
}

// Getting viewed order data from db.
$orderId;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $orderId = $_GET['id'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {id} IN YOUR URL!";
}
$order = getOrderById($orderId);
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
    <main class="main">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Order Index [<?= $orderIndex ?>]</h2>

            <section class="order__container">

                <div class="main_info">
                    <div class="order-id-field">
                        <h2>
                            ID 
                            <span>
                                <?= $order['id'] ?>
                                <input type="hidden" id="order-id" value="<?= $order['id'] ?>">
                            </span>
                        </h2>
                    </div>
                    <div class="order-status-field">
                        <h2>
                            Status 
                            <div class="order-status-select-box">
                                <select id="order-status" name="order-status">
                                    <!-- Order status options -->
                                    <option hidden value="">SELECT STATUS</option>
                                    <option <?php if ($order['order_status'] == 'CANCELED') echo 'selected' ?> value="CANCELED">CANCELED</option>
                                    <option <?php if ($order['order_status'] == 'NOT STARTED') echo 'selected' ?> value="NOT STARTED">NOT STARTED</option>
                                    <option <?php if ($order['order_status'] == 'IN PROGRESS') echo 'selected' ?> value="IN PROGRESS">IN PROGRESS</option>
                                    <option <?php if ($order['order_status'] == 'COMPLETED') echo 'selected' ?> value="COMPLETED">COMPLETED</option>
                                </select>
                            </div>
                        </h2>
                    </div>
                </div>

                <div class="order-content">
                    <div class="order-content__group">
                        <div class="order-content-block contact_info">
                            <h3>Contact Info</h3>
        
                            <table>
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-cell="customer"><?= $order['firstname'] ?> <?= $order['lastname'] ?></td>
                                        <td data-cell="email"><?= $order['email'] ?></td>
                                        <td data-cell="phone"><?= $order['phone'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="order-content-block address_info">
                            <h3>Address Info</h3>
        
                            <table>
                                <thead>
                                    <tr>
                                        <th>Postal Code</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-cell="postal code"><?= $order['postal_code'] ?></td>
                                        <td data-cell="address"><?= $order['address'] ?></td>
                                        <td data-cell="city"><?= $order['city'] ?></td>
                                        <td data-cell="location"><?= $order['location'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
    
                    <div class="order-content__group">
                        <div class="order-content-block order_info">
                            <h3>Order Info</h3>
            
                            <table>
                                <thead>
                                    <tr>
                                        <th>Creation Date</th>
                                        <th>Preferred Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                    <tr>
                                        <td data-cell="creation date"><?= $order['created_date'] ?></td>
                                        <td data-cell="preferred date"><?= $order['date'] ?? '[empty]' ?></td>
                                        <td data-cell="time"><?= $order['time'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div class="order-content-block products_info">
                            <h3>Products</h3>
    
                            <ul>
                                <li>Carpet</li>
                                <li>Wool Carpet</li>
                                <li>Cork</li>
                                <li>Vinyl</li>
                                <li>Luxury Vinyl</li>
                                <li>Hardwood</li>
                                <li>Tile</li>
                                <li>Carpet Tile</li>
                                <li>Laminate</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                <div class="order_comment">
                    <h3>Comment</h3>
                    
                    <p><?= !empty($order['comments']) ? $order['comments'] : '[empty]' ?></p>
                </div>

            </section>

            <div class="link-and-button_flex">
                <a href="
                    <?= BASE_URL . queryString($returnLink, [
                        'page' => $dataTablePage,
                    ]); ?>
                " 
                class="btn-link">
                    Back
                </a>
                <button onclick="saveOrderStatus()">Save</button>
            </div>
        </section>

        <!-- <section class="page-section">
            <h2>Order Index [5]</h2>

            <section class="order__container">

                <div class="main_info">
                    <div class="order-id-field">
                        <h2>
                            ID <span id="order-id">5</span>
                        </h2>
                    </div>
                    <div class="order-status-field">
                        <h2>
                            Status 
                            <div class="order-status-select-box">
                                <select id="order-status" name="order-status">
                                    -- Order status options --
                                    <option hidden value="">SELECT STATUS</option>
                                    <option value="CANCELED">CANCELED</option>
                                    <option value="NOT STARTED">NOT STARTED</option>
                                    <option value="IN PROGRESS">IN PROGRESS</option>
                                    <option value="COMPLETED">COMPLETED</option>
                                </select>
                            </div>
                        </h2>
                    </div>
                </div>

                <div class="order-content">
                    <div class="order-content__group">
                        <div class="order-content-block contact_info">
                            <h3>Contact Info</h3>
        
                            <table>
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-cell="customer">Sienna Krueger</td>
                                        <td data-cell="email">emailaddress@gmail.com</td>
                                        <td data-cell="phone">+15063416048</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
        
                        <div class="order-content-block address_info">
                            <h3>Address Info</h3>
        
                            <table>
                                <thead>
                                    <tr>
                                        <th>Postal Code</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-cell="postal code">postalcode</td>
                                        <td data-cell="address">someaddress</td>
                                        <td data-cell="city">cityname</td>
                                        <td data-cell="location">location</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
    
                    <div class="order-content__group">
                        <div class="order-content-block order_info">
                            <h3>Order Info</h3>
            
                            <table>
                                <thead>
                                    <tr>
                                        <th>Creation Date</th>
                                        <th>Preferred Date</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>                            
                                    <tr>
                                        <td data-cell="creation date">2024-12-06 02:01:52</td>
                                        <td data-cell="preferred date">2024-12-26</td>
                                        <td data-cell="time">Afternoon</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
    
                        <div class="order-content-block products_info">
                            <h3>Products</h3>
    
                            <ul>
                                <li>Carpet</li>
                                <li>Wool Carpet</li>
                                <li>Cork</li>
                                <li>Vinyl</li>
                                <li>Luxury Vinyl</li>
                                <li>Hardwood</li>
                                <li>Tile</li>
                                <li>Carpet Tile</li>
                                <li>Laminate</li>
                            </ul>
                        </div>
                    </div>
                    
                </div>

                <div class="order_comment">
                    <h3>Comment</h3>
                    
                    <p>Some comment ... </p>
                </div>

            </section>

            <div class="link-and-button_flex">
                <a href="../admin/orders/orders.php" class="btn-link">Back</a>
                <button onclick="saveOrderStatus()">Save</button>
            </div>
        </section> -->

    </main>

</body>
</html>