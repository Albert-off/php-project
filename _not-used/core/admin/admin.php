<?php
session_start();

require_once "../path.php";

require_once SITE_ROOT . '/src/helpers.php';

// Allow or deny access to a user.
checkAuth();

// To display current user data in admin sidebar. 
$user = currentUser();

// get home_page_content db data
$homeContent = returnHomePageContent();
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
    <nav id="admin-sidebar">

        <div class="sidebar-logo">
            <img src="<?= BASE_URL . '/' . $user['avatar'] ?>" alt="">
            <div>
                <h3><?= $user['name'] ?></h3>
                <span><?= $user['email'] ?></span>
            </div>
        </div>

        <ul>
            <li>
                <span class="sidebar-name">Admin Dashboard</span>
                <button onclick="toggleSidebar()" id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg>
                </button>
            </li>

            <hr>

            <li class="admin_li">
                <a href="<?= BASE_URL ?>admin/admin.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                    <span>Home</span>
                </a>
            </li>

            <li class="orders_li">
                <a href="<?= BASE_URL ?>admin/orders/orders.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M440-183v-274L200-596v274l240 139Zm80 0 240-139v-274L520-457v274Zm-80 92L160-252q-19-11-29.5-29T120-321v-318q0-22 10.5-40t29.5-29l280-161q19-11 40-11t40 11l280 161q19 11 29.5 29t10.5 40v318q0 22-10.5 40T800-252L520-91q-19 11-40 11t-40-11Zm200-528 77-44-237-137-78 45 238 136Zm-160 93 78-45-237-137-78 45 237 137Z"/></svg>
                    <span>Orders</span>
                </a>
            </li>

            <!-- <li>
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z"/></svg>
                    <span>Dashboard</span>
                </a>
            </li> -->

            <!-- Dropdown Menu -->
            <!-- <li>
                <button onclick=toggleSubMenu(this) class="dropdown-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M222-200 80-342l56-56 85 85 170-170 56 57-225 226Zm0-320L80-662l56-56 85 85 170-170 56 57-225 226Zm298 240v-80h360v80H520Zm0-320v-80h360v80H520Z"/></svg>
                    <span>Todo-Lists</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="sub-menu">
                    <div>
                        <li><a href="#">Work</a></li>
                        <li><a href="#">Priate</a></li>
                        <li><a href="#">Coding</a></li>
                        <li><a href="#">Gardening</a></li>
                        <li><a href="#">School</a></li>
                    </div>
                </ul>
            </li> -->

            <!-- Dropdown Menu 1 -->
            <li>
                <button onclick=toggleSubMenu(this) class="dropdown-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                    <span>Users</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="sub-menu">
                    <div>
                        <li><a href="dex.php">List</a></li>
                        <li><a href="eate.php">Create</a></li>
                    </div>
                </ul>
            </li>

            <!-- Dropdown Menu 2 -->
            <li>
                <button onclick=toggleSubMenu(this) class="dropdown-btn"> <!-- .rotate class added -->
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120Zm-40-160H240v60h480v-60Zm-480-60h480v-60H240v60Zm0-140h480v-240H240v240Zm0 200v60-60Zm0-60v-60 60Zm0-140v-240 240Zm0 80v-80 80Zm0 120v-60 60Z"/></svg>
                    <span>Posts</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="sub-menu"> <!-- .show class added -->
                    <div>
                        <li><a href="<?= BASE_URL ?>admin/posts/index.php">List</a></li>
                        <li><a href="<?= BASE_URL ?>admin/posts/create.php">Create</a></li>
                    </div>
                </ul>
            </li>

            <!-- Dropdown Menu 3 -->
            <li>
                <button onclick=toggleSubMenu(this) class="dropdown-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80q-33 0-56.5-23.5T80-160v-360q0-33 23.5-56.5T160-600h80v-200q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v360q0 33-23.5 56.5T800-360h-80v200q0 33-23.5 56.5T640-80H160Zm0-80h480v-280H160v280Zm560-280h80v-280H320v120h320q33 0 56.5 23.5T720-520v80Z"/></svg>
                    <span>Pages</span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                </button>
                <ul class="sub-menu">
                    <div>
                        <li><a href="me.php">Home</a></li>
                        <li><a href="ooring-installation.php">Flooring Installation</a></li>
                        <li><a href="outus.php">About Us</a></li>
                    </div>
                </ul>
            </li>

            <hr>

            <li>
                <a href="<?= BASE_URL ?>">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h420v-140H160v140Zm500 0h140v-360H660v360ZM160-460h420v-140H160v140Z"/></svg>
                    <span>View website</span>
                </a>
            </li>

            <li>
                <a style="cursor: pointer;" href="javascript:{}" onclick="document.getElementById('logout-form').submit();">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    <span>Logout</span>
                    <form id="logout-form" action="../src/actions/logout.php" method="post" style="display: none;"></form>
                </a>
            </li>
        </ul>
    </nav>

    <!-- ================ MAIN ================ -->
    <main class="main" id="sidebar_admin">

        <!--==================== ADMIN SECTION ====================-->
        <div class="page-section">
            <h2>Feature 1</h2>

            <div class="feature-content__grid">

                <div class="upload-container">
                    <figure class="upload-image-container">
                        <img id="choosen-img-1" src="../uploads/home-images/<?= $homeContent['feature_img_url1'] ?>" alt="">
                        <figcaption id="file-name-1">
                            <?= $homeContent['feature_img_url1'] ?? 'Demo File Name' ?>
                        </figcaption>
                    </figure>

                    <input type="file" id="upload-button-1" accept="image/*">
                    <label for="upload-button-1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80v-80h640v80H160Zm200-160v-280H200l280-360 280 360H600v280H360Zm80-80h80v-280h76L480-750 364-600h76v280Zm40-280Z"/></svg>
                        Choose a photo
                    </label>
                </div>
                
                <div class="feture-content__group">
                    <textarea id="feature-title-1" maxlength="35" oninput="autoResize(this)" rows="1"><?= $homeContent['feature_title1'] ?></textarea>
                    <textarea id="feature-description-1" maxlength="320" oninput="autoResize(this)"><?= $homeContent['feature_descripton1'] ?></textarea>
                </div>
            </div>

            <div class="feature-list__group">
                <input id="feature-item-1-1" type="text" maxlength="25" value="<?= $homeContent['feature_item_1'] ?>">
                <input id="feature-item-1-2" type="text" maxlength="25" value="<?= $homeContent['feature_item_2'] ?>">
                <input id="feature-item-1-3" type="text" maxlength="25" value="<?= $homeContent['feature_item_3'] ?>">
                <input id="feature-item-1-4" type="text" maxlength="25" value="<?= $homeContent['feature_item_4'] ?>">
            </div>

            <button onclick="saveFeature(true)">Save</button>
        </div>

        <div class="page-section">
            <h2>Feature 2</h2>

            <div class="feature-content__grid">
                
                <div class="upload-container">
                    <figure class="upload-image-container">
                        <img id="choosen-img-2" src="../uploads/home-images/<?= $homeContent['feature_img_url2'] ?>" alt="">
                        <figcaption id="file-name-2">
                            <?= $homeContent['feature_img_url2'] ?? 'Demo File Name' ?>
                        </figcaption>
                    </figure>

                    <input type="file" id="upload-button-2" accept="image/*">
                    <label for="upload-button-2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M160-80v-80h640v80H160Zm200-160v-280H200l280-360 280 360H600v280H360Zm80-80h80v-280h76L480-750 364-600h76v280Zm40-280Z"/></svg>
                        Choose a photo
                    </label>
                </div>

                <div class="feture-content__group">
                    <textarea id="feature-title-2" maxlength="35" oninput="autoResize(this)" rows="1"><?= $homeContent['feature_title2'] ?></textarea>
                    <textarea id="feature-description-2" maxlength="320" oninput="autoResize(this)"><?= $homeContent['feature_descripton2'] ?></textarea>
                </div>
            </div>

            <div class="feature-list__group">
                <input id="feature-item-2-1" type="text" maxlength="25" value="<?= $homeContent['feature_item2_1'] ?>">
                <input id="feature-item-2-2" type="text" maxlength="25" value="<?= $homeContent['feature_item2_2'] ?>">
                <input id="feature-item-2-3" type="text" maxlength="25" value="<?= $homeContent['feature_item2_3'] ?>">
                <input id="feature-item-2-4" type="text" maxlength="25" value="<?= $homeContent['feature_item2_4'] ?>">
            </div>

            <button onclick="saveFeature(false)">Save</button>
        </div>

        <div class="page-section">
            <h2>Questions</h2>
            
            <textarea id="questions-title" maxlength="40" oninput="autoResize(this)" rows="1"><?= $homeContent['question_title'] ?></textarea>
            
            <div class="question-answer__grid">
                <div class="input-flex-column">
                    <h4>Question-Answer 1</h4>
                    <textarea id="question-1" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question1_text'] ?></textarea>
                    <textarea id="answer-1" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer1_text'] ?></textarea>
                </div>

                <div class="input-flex-column">
                    <h4>Question-Answer 2</h4>
                    <textarea id="question-2" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question2_text'] ?></textarea>
                    <textarea id="answer-2" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer2_text'] ?></textarea>
                </div>

                <div class="input-flex-column">
                    <h4>Question-Answer 3</h4>
                    <textarea id="question-3" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question3_text'] ?></textarea>
                    <textarea id="answer-3" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer3_text'] ?></textarea>
                </div>

                <div class="input-flex-column">
                    <h4>Question-Answer 4</h4>
                    <textarea id="question-4" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question4_text'] ?></textarea>
                    <textarea id="answer-4" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer4_text'] ?></textarea>
                </div>

                <div class="input-flex-column">
                    <h4>Question-Answer 5</h4>
                    <textarea id="question-5" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question5_text'] ?></textarea>
                    <textarea id="answer-5" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer5_text'] ?></textarea>
                </div>

                <div class="input-flex-column">
                    <h4>Question-Answer 6</h4>
                    <textarea id="question-6" maxlength="70" oninput="autoResize(this)"><?= $homeContent['question6_text'] ?></textarea>
                    <textarea id="answer-6" maxlength="245" oninput="autoResize(this)"><?= $homeContent['answer6_text'] ?></textarea>
                </div>
            </div>

            <button onclick="saveQuestions()">Save</button>
        </div>

        <!-- dinamic image: https://loremflickr.com/45/45?random=1 -->

    </main>

</body>
</html>