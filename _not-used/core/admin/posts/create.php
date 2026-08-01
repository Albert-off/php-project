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
    <main class="main data-list" id="sidebar_posts_create">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Create Post</h2>

            <!--============ POSTS NAV ============-->
            <nav class="posts-nav">
                <ul class="posts-nav__list">
                    <li class="posts-nav__link">
                        <a href="<?= BASE_URL ?>admin/posts/index.php">
                            Posts List
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M80-160v-160h160v160H80Zm240 0v-160h560v160H320ZM80-400v-160h160v160H80Zm240 0v-160h560v160H320ZM80-640v-160h160v160H80Zm240 0v-160h560v160H320Z"/></svg>
                        </a>
                    </li>
                    <li class="posts-nav__link link-active">
                        <a href="<?= BASE_URL ?>admin/posts/create.php">
                            Create Post
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h360v80H200v560h560v-360h80v360q0 33-23.5 56.5T760-120H200Zm120-160v-80h320v80H320Zm0-120v-80h320v80H320Zm0-120v-80h320v80H320Zm360-80v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="posts">

                <form class="create-form" action="../../src/actions/posts/create-post.php" method="post" enctype="multipart/form-data">
                    <div class="form-wrapper <?= has_error('title'); ?>">
                        <label for="title">Title</label>
                        <textarea 
                            name="title"
                            placeholder="Title"
                            oninput="autoResize(this)"
                            rows="1"
                            required
                        ><?= getOldValue('title'); ?></textarea>

                        <?= display_error('title'); ?>
                    </div>

                    <!-- upload post photos -->
                    <div class="form-wrapper <?= has_error('post-images'); ?> form-upload">

                        <label for="post-images">Choose a photo</label>
                        <input 
                            name="post-images[]" 
                            type="file" 
                            id="post-images"
                            accept="image/png, image/jpeg"
                            onchange="uploadedImagesPreview()"
                            multiple 
                        />
                        
                        <div class="uploaded-post-images-container">
                            <p id="num-of-uploaded-post-files">No Files Chosen</p>
                            <div class="uploaded-post-images" id="uploaded-post-images"></div>
                        </div>

                        <label for="post-images" class="post-photo-upload-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80v-80h640v80H160Zm200-160v-280H200l280-360 280 360H600v280H360Zm80-80h80v-280h76L480-750 364-600h76v280Zm40-280Z"/></svg>
                            Upload photo
                        </label>
                        
                        <?= display_error('post-images'); ?>
                    </div>

                    <div class="form-wrapper <?= has_error('description'); ?>">
                        <label for="description">Description</label>
                        <textarea 
                            name="description"
                            placeholder="Description"
                            oninput="autoResize(this)"
                            required
                        ><?= getOldValue('description'); ?></textarea>

                        <?= display_error('description'); ?>
                    </div>

                    <div class="form-group-wrapper">
                        <div class="form-wrapper">
                            <label for="post_status">Status</label>
                            <select name="post_status">
                                <option default value="PUBLISHED">PUBLISHED</option>
                                <option value="UNPUBLISHED">UNPUBLISHED</option>
                            </select>
                        </div>
    
                        <button type="submit" class="create-btn">
                            Create
                        </button>
                    </div>
                </form>

            </div>

        </section>
    </main>

</body>
</html>