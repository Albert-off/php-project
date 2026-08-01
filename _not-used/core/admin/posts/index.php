<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar.
$user = currentUser();

// Getting all posts from DB.
$posts = getAllPosts();


// --======== DATA PAGINATION ========-- 
// 1. Total count of posts.
$totalPosts = count($posts);

// 2. Determine the current page based on the parameter from the URL. 
// If the page is not specified, set the value to 1.
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// 3. Set the number of posts on one page and calculate the total number of pages.
$postsPerPage = 5;
$totalPages = ceil($totalPosts / $postsPerPage);

// 4. Getting posts for the current page using array_slice(array, start, length, preserve).
$offset = ($currentPage - 1) * $postsPerPage;
$currentPosts = array_slice($posts, $offset, $postsPerPage);

// 5. Output of posts with pagination. We'll use $currentPosts to display the posts.
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
    <main class="main data-list" id="sidebar_posts_list">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Posts</h2>

            <!--============ POSTS NAV ============-->
            <nav class="posts-nav">
                <ul class="posts-nav__list">
                    <li class="posts-nav__link link-active">
                        <a href="<?= BASE_URL ?>admin/posts/index.php">
                            Posts List
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/></svg>
                        </a>
                    </li>
                    <li class="posts-nav__link">
                        <a href="<?= BASE_URL ?>admin/posts/create.php">
                            Create Post
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm120-160v-80h320v80H320Zm0-120v-80h320v80H320Zm0-120v-80h320v80H320Zm360-80v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="data-table" id="data-table">
    
                <section class="table__header">
                    <h1>Posts List [<?= $totalPosts ?>]</h1>
                    <div class="input-group">
                        <input type="search" placeholder="Search Post...">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                    </div>
                </section>
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
    
                            <?php 
                                $index = $offset + 1;
                                foreach($currentPosts as $post): 
                                
                                    // choosing post status .class for css styles
                                    $postStatusClass = '';
    
                                    if ($post['post_status'] === 'PUBLISHED') { $postStatusClass = 'published'; }
                                    else if ($post['post_status'] === 'UNPUBLISHED') { $postStatusClass = 'unpublished'; }
                                ?>
                                <tr id="post-<?= $post['id'] ?>">
                                    <td><?= $index++; ?></td>
                                    <td><?= $post['created_date'] ?></td>
                                    <td><?= truncateString($post['title'], 16); ?></td>
                                    <td><?= truncateString($post['description'], 16); ?></td>

                                    <td><span class="post-status <?= $postStatusClass ?>"><?= $post['post_status'] ?></span></td>

                                    <td>
                                        <a href="
                                            <?= BASE_URL . queryString('admin/posts/view.php', [
                                                'page'  => $currentPage,
                                                'index' => $index - 1,
                                                'id'    => $post['id']
                                            ]); ?>
                                        " 
                                        class="view-btn">
                                           View
                                        </a>
                                    </td>

                                    <td>
                                        <a href="
                                            <?= BASE_URL . queryString('admin/posts/edit.php', [
                                                'id' => $post['id']
                                            ]); ?>
                                        " 
                                        class="edit-btn">
                                            Edit
                                        </a>
                                    </td>

                                    <td><button onclick="permanentlyDeleteSelectedPost(<?= $post['id'] ?>)" class="del-btn">Delete</button></td>
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