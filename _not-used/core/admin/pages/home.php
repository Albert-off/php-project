<?php
session_start();

require_once "../../path.php";

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
    <?php require_once SITE_ROOT . "/includes/admin-sidebar.php"; ?>

    
    <!-- ================ MAIN ================ -->
    <main class="main" id="sidebar_pages_home">

        <!--==================== ADMIN SECTION ====================-->
        <section class="page-section">
            <h2>Feature 1</h2>

            <div class="feature-content__grid">

                <div class="feture-banner__group">
                    <div class="upload-container">
                        <figure class="upload-image-container">
                            <img id="choosen-img-1" src="<?= BASE_URL ?>/uploads/home-images/<?= $homeContent['feature_img_url1'] ?>" alt="">
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
                </div>
                
                <div class="feture-content__group">
                    <textarea id="feature-title-1" maxlength="35" oninput="autoResize(this)" rows="1"><?= $homeContent['feature_title1'] ?></textarea>
                    <textarea id="feature-description-1" maxlength="320" oninput="autoResize(this)"><?= $homeContent['feature_descripton1'] ?></textarea>
                </div>

                <div class="feature-list__group">
                    <input id="feature-item-1-1" type="text" maxlength="25" value="<?= $homeContent['feature_item_1'] ?>">
                    <input id="feature-item-1-2" type="text" maxlength="25" value="<?= $homeContent['feature_item_2'] ?>">
                    <input id="feature-item-1-3" type="text" maxlength="25" value="<?= $homeContent['feature_item_3'] ?>">
                    <input id="feature-item-1-4" type="text" maxlength="25" value="<?= $homeContent['feature_item_4'] ?>">
                </div>
            </div>

            <button onclick="saveFeature(true)">Save</button>
        </section>

        <section class="page-section">
            <h2>Feature 2</h2>

            <div class="feature-content__grid">

                <div class="feture-banner__group">
                    <div class="upload-container">
                        <figure class="upload-image-container">
                            <img id="choosen-img-2" src="<?= BASE_URL ?>/uploads/home-images/<?= $homeContent['feature_img_url2'] ?>" alt="">
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
                </div>

                <div class="feture-content__group">
                    <textarea id="feature-title-2" maxlength="35" oninput="autoResize(this)" rows="1"><?= $homeContent['feature_title2'] ?></textarea>
                    <textarea id="feature-description-2" maxlength="320" oninput="autoResize(this)"><?= $homeContent['feature_descripton2'] ?></textarea>
                </div>

                <div class="feature-list__group">
                    <input id="feature-item-2-1" type="text" maxlength="25" value="<?= $homeContent['feature_item2_1'] ?>">
                    <input id="feature-item-2-2" type="text" maxlength="25" value="<?= $homeContent['feature_item2_2'] ?>">
                    <input id="feature-item-2-3" type="text" maxlength="25" value="<?= $homeContent['feature_item2_3'] ?>">
                    <input id="feature-item-2-4" type="text" maxlength="25" value="<?= $homeContent['feature_item2_4'] ?>">
                </div>
            </div>

            <button onclick="saveFeature(false)">Save</button>
        </section>

        <section class="page-section">
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
        </section>

    </main>

</body>
</html>