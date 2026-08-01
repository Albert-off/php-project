<?php
session_start();

require_once "../../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();


// --======== GET URL VALUES ========--
// Getting sended page value to go back at the right page in data-table.
$dataTablePage;
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $dataTablePage = $_GET['page'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {page} IN YOUR URL!";
}

// Getting sended index value to go back at the right index in data-table.
$postIndex;
if (isset($_GET['index']) && !empty($_GET['index'])) {
    $postIndex = $_GET['index'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {index} IN YOUR URL!";
}

// Getting viewed post data from db.
$postId;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $postId = $_GET['id'];
} else {
    echo "ERROR MESSAGE: THERE IS NO {id} IN YOUR URL!";
}
$post = getPostById($postId);

// Getting selected post photos from post_image table.
$postImagesPaths = getPostImagesPathsByPostId($postId);
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
            <h2>Post Index [<?= $postIndex ?>]</h2>

            <section class="post__container">
                
                <div class="main_info">
                    <div class="post-id-field">
                        <h2>
                            ID 
                            <span>
                                <?= $post['id'] ?>
                                <input type="hidden" id="post-id" value="<?= $post['id'] ?>">
                            </span>
                        </h2>
                    </div>
                    <div class="post-status-field">
                        <h2>
                            Status 
                            <div class="post-status-select-box">
                                <select id="post-status" name="post-status">
                                    <!-- Post status options -->
                                    <option <?php if ($post['post_status'] == 'PUBLISHED') echo 'selected' ?> value="PUBLISHED">PUBLISHED</option>
                                    <option <?php if ($post['post_status'] == 'UNPUBLISHED') echo 'selected' ?> value="UNPUBLISHED">UNPUBLISHED</option>
                                </select>
                            </div>
                        </h2>
                    </div>
                </div>

                <div class="post-content">

                    <div class="post-slider" id="post-slider">
                            <?php
                                $imagesCount = count($postImagesPaths);
                                $imageIndex = 1;

                                foreach ($postImagesPaths as $postImage): ?>

                                <div class="post-slide">
                                    <div class="slide-number"><?= $imageIndex++; ?> / <?= $imagesCount ?></div>
                                    <img src="<?= BASE_URL . $postImage['image_path'] ?>" alt="">
                                </div>

                            <?php endforeach; ?>

                        <!-- <div class="post-slide">
                            <div class="slide-number">2 / 5</div>
                            <img src="assets/img/products/carpet/img1.jpg" alt="">
                        </div>
                        <div class="post-slide">
                            <div class="slide-number">3 / 5</div>
                            <img src="assets/img/carousel/otherimgs/img4.jpg" alt="">
                        </div>
                        <div class="post-slide">
                            <div class="slide-number">4 / 5</div>
                            <img src="assets/img/products/carpet/img3.jpg" alt="">
                        </div>
                        <div class="post-slide">
                            <div class="slide-number">5 / 5</div>
                            <img src="assets/img/products/carpet/img4.jpg" alt="">
                        </div> -->
                    
                        <div class="post-pagination-and-arrows">
                            <div class="post-slider__pagination">
                                <?php for ($i = 1; $i <= $imagesCount; $i++): ?>
                                    <span class="dot" onclick="currentSlide(<?= $i ?>)"> </span>
                                <?php endfor; ?>
                            </div>

                            <div class="post-slider__arrows">
                                <button class="prev-arrow" onclick="moveSlides(-1)">&#10094;</button>
                                <button class="next-arrow" onclick="moveSlides(1)">&#10095;</button>
                            </div>
                        </div>
                    </div>

                    <?php if ($post['title']): ?>
                        <h2><?= $post['title'] ?></h2>
                    <?php endif; ?>

                    <p><?= $post['description'] ?></p>
                </div>

            </section>

            <div class="link-and-button_flex">
                <a href="
                    <?= BASE_URL . queryString('admin/posts/index.php', [
                        'page' => $dataTablePage,
                    ]); ?>
                " 
                class="btn-link">
                    Back
                </a>
                <button onclick="savePostStatus()">Save</button>
            </div>
        </section>

    </main>

</body>
</html>