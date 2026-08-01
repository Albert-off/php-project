<?php


require_once __DIR__ . "/config.php";



function redirect(string $path) 
{
    header("Location: $path");
    die();
}


// Helper funtcion for validation
function setValidationError(string $field, string $message) 
{
    $_SESSION['validation'][$field] = $message;
}


// Helper functions for error checking
function has_error($field): string
{ 
    return isset($_SESSION['validation'][$field]) ? 'error-border' : ''; 
} 

// Remove errors from session after display
function display_error($field): string 
{ 
    $message = isset($_SESSION['validation'][$field]) ? '<div class="error-message">' . $_SESSION['validation'][$field] . '</div>' : '';
    unset($_SESSION['validation'][$field]);
    return $message;
}


// Add and display old values
function setOldValue(string $key, $value) : void
{
    $_SESSION['old'][$key] = $value;
}

function getOldValue(string $key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}


// Upload file
function uploadFile(array $file, string $prefix = ''): string
{
    // package where we will store files.
    $uploadPath = __DIR__ . '/../uploads';


    // If package doesn't exist we'll create it.
    if(!is_dir('../../uploads')) {
        // path direction, permissions, recursive
        mkdir($uploadPath, 0777, true);
    }


    // getting the extension of that file (without dot).
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    // setting the file name.
    $fileName = $prefix . '_' . time() . ".$ext" ;
    // $fileName example: avatar_1731443492.png


    // uploading process.
    if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
        die('Error uploading file to server.');

        // We need to redirect this with some error message
    }

    // we can return this path for example to store it in db.
    return "uploads/$fileName";
}


// woriking with DB using PDO
function getPDO(): PDO
{
    try {
        return new \PDO(
            'mysql:host='.DB_HOST.';port='.DB_PORT.';charset=utf8;dbname='.DB_NAME, 
            DB_USERNAME, 
            DB_PASSWORD
        );
    } catch (\PDOException $e) {
        die("Connection error: {$e->getMessage()}");
    }
}


/**
 * @return array|bool
*/
function findUser(string $email)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE `email` = :email");
    $stmt->execute(['email' => $email]);

    // We receive our user in the form of some array.
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $user;
}


// Helper function that checks email unique and returns boolean true if user with provided email already exist in db.
/**
 * @return bool
*/
function isEmailUnique($email) {

    $pdo = getPDO();

    // SQL query to check email unique.
    $query = "SELECT 1 FROM users WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);

    $emailExists = $stmt->fetchColumn();

    // Returning true, if email is unique, otherwise false.
    return $emailExists === false; 
}


// Helper function that will return us array or boolean false (if user with provided id not exist in db).
/**
 * @return array|bool
*/
function getUserById(string $userId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->execute(['id' => $userId]);

    // We receive our user in the form of some array.
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $user;
}


// Helper function that will return us array or boolean false (if order not exist in db).
/**
 * @return array|bool
*/
function getOrderById(string $orderId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE `id` = :id");
    $stmt->execute(['id' => $orderId]);

    // We receive our order in the form of some array.
    $order = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $order;
}


// Helper function that will return us array or boolean false (if post not exist in db).
/**
 * @return array|bool
*/
function getPostById(string $postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts WHERE `id` = :id");
    $stmt->execute(['id' => $postId]);

    // We receive our post in the form of some array.
    $post = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $post;
}

// Helper function that will return us array or boolean false 
// if post images doesn't exist in posts_images table.
/**
 * @return array|bool
*/
function getPostImagesPathsByPostId(string $postId)
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts_images WHERE `post_id` = :id");
    $stmt->execute(['id' => $postId]);

    // We receive our post images in the form of some array.
    $postImages = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $postImages;
}


// Helper function that will return us array or boolean false (if user not exist in db).
/**
 * @return array|false
*/
function currentUser()
{
    $pdo = getPDO();

    // If we don't have any user in our session it will return false.
    if (!isset($_SESSION['user'])) {
        return false;
    }

    $userId = $_SESSION['user']['id'] ?? null;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE `id` = :id");
    $stmt->execute(['id' => $userId]);

    // We receive our user in the form of some array.
    $user = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $user;
}


/* ----======== GET ALL USERS AND ORDERS ========---- */

// Helper function that will return us array of users or boolean false (if no users in db).
/**
 * @return array|false
*/
function getAllUsers()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();

    // We receive all users in the form of an array.
    $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $users;
}

// Helper function that will return us array of posts or boolean false (if no posts in db).
/**
 * @return array|false
*/
function getAllPosts()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM posts");
    $stmt->execute();

    // We receive all posts in the form of an array.
    $posts = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $posts;
}

// Helper function that will return us array of oders or boolean false (if no orders in db).
/**
 * @return array|false
*/
function getAllOrders()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM orders");
    $stmt->execute();

    // We receive all orders in the form of an array.
    $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $orders;
}

// Helper function that will return us array of ACTIVE oders or boolean false (if no ACTIVE orders in db).
/**
 * @return array|false
*/
function getAllActiveOrders()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE `order_state` = :order_state ");
    $stmt->execute(['order_state' => 'ACTIVE']);

    // We receive all ACTIVE orders in the form of an array.
    $activeOrders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $activeOrders;
}

// Helper function that will return us array of ARCHIVED oders or boolean false (if no ARCHIVED orders in db).
/**
 * @return array|false
*/
function getAllArchivedOrders()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE `order_state` = :order_state ");
    $stmt->execute(['order_state' => 'ARCHIVED']);

    // We receive all ARCHIVED orders in the form of an array.
    $archivedOrders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $archivedOrders;
}

// Helper function that will return us array of DELETED oders or boolean false (if no DELETED orders in db).
/**
 * @return array|false
*/
function getAllSoftDeletedOrders()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE `order_state` = :order_state ");
    $stmt->execute(['order_state' => 'DELETED']);

    // We receive all DELETED orders in the form of an array.
    $softDeletedOrders = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    return $softDeletedOrders;
}


/* ----======== GET PAGES CONTENTS ========---- */

// Helper function that will return us array or boolean false (if home_page_content not exist in db).
/**
 * @return array|false
*/
function returnHomePageContent()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM home_page_content WHERE `id` = :id");
    $stmt->execute(['id' => 1]);

    // We receive our home_page_content in the form of some array.
    $homeContent = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $homeContent;
}

// Helper function that will return us array or boolean false (if fl_install_page_content not exist in db).
/**
 * @return array|false
*/
function returnFlInstallPageContent()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM fl_install_page_content WHERE `id` = :id");
    $stmt->execute(['id' => 1]);

    // We receive our fl_install_page_content in the form of some array.
    $homeContent = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $homeContent;
}

// Helper function that will return us array or boolean false (if aboutus_page_content not exist in db).
/**
 * @return array|false
*/
function returnAboutUsPageContent()
{
    $pdo = getPDO();

    $stmt = $pdo->prepare("SELECT * FROM aboutus_page_content WHERE `id` = :id");
    $stmt->execute(['id' => 1]);

    // We receive our aboutus_page_content in the form of some array.
    $homeContent = $stmt->fetch(\PDO::FETCH_ASSOC);

    return $homeContent;
}



// auth helper functions
function setMessage(string $key, string $message): void
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage(string $key): bool
{
    return isset($_SESSION['message'][$key]);
}

function getMessage(string $key): string
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}



// Logout function.
function logout(): void
{
    unset($_SESSION['user']['id']);
    redirect('/');
}



// Helper function that prevent page access if user don't have session.
function checkAuth(): void
{
    if (!isset($_SESSION['user']['id'])) {
        redirect('/');
    }
}


// Helper function that will check if the user not authorised.
function checkGuest(): void
{
    if (isset($_SESSION['user']['id'])) {
        redirect('/admin/admin.php');
    }
}



// Helper function that will check last auto delete time and return true or false if it's time to delete-expired-orders.php once a day.
function runDailyCleanup()
{
    $lastRunFile = SITE_ROOT . '/src/storage/last_run_time.txt';

    // Checking the last execution time.
    if (file_exists($lastRunFile)) {
        $lastRunTime = file_get_contents($lastRunFile);
    } else {
        $lastRunTime = 0; // If the file does not exist, set to 0.
    }

    $currentDate = new DateTime();
    $lastRunDate = new DateTime();
    $lastRunDate->setTimestamp((int)$lastRunTime);

    // Compare dates
    if ($currentDate->format('Y-m-d') !== $lastRunDate->format('Y-m-d')) {
        // Updating the last execution time.
        file_put_contents($lastRunFile, $currentDate->getTimestamp());

        
        // Output buffering.
        ob_start();
        
        // Running a script to delete orders with expired auto_delete_date attributes.
        require_once SITE_ROOT . '/src/actions/orders/delete-expired-orders.php';

        // Getting buffered output and ending buffering.
        $output = ob_get_clean();

        // Returning buffered output.
        return $output;
    }
}



// Helper function that checks the length of the text and, if it is longer than the selected one, truncates it and adds the prefix "..".
function truncateString($text, $maxLength, $suffix = '..')
{
    if (strlen($text) > $maxLength) {
        return helpers . phpsubstr($text, 0, $maxLength - strlen($suffix)) . $suffix;
    }
    return $text;
}

// $text = "Akuna Matata";
// $truncated = truncateString($text, 8, '..');
// echo $truncated; // Вывод: Akuna Ma..



// Helper function for convenient query string implementation.
function queryString(string $path = '', array $params = [])
{
    $query = http_build_query($params);
    return $path . '?' . $query;
}
