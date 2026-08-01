<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $featureTitle1 = $_POST['feature_title1'];
    $featureDescription1 = $_POST['feature_descripton1'];
    $featureItem1_1 = $_POST['feature_item_1'];
    $featureItem1_2 = $_POST['feature_item_2'];
    $featureItem1_3 = $_POST['feature_item_3'];
    $featureItem1_4 = $_POST['feature_item_4'];

    $uploadedImage1 = $_FILES['feature_img_url1'] ?? null;
    $uploadedImagePath1 = null;

    // Обработка загрузки файла
    // if (isset($_FILES['feature_img_url1']) && $_FILES['feature_img_url1']['error'] === UPLOAD_ERR_OK) {
    //     $fileTmpPath = $_FILES['feature_img_url1']['tmp_name'];
    //     $fileName = $_FILES['feature_img_url1']['name'];
    //     $fileSize = $_FILES['feature_img_url1']['size'];
    //     $fileType = $_FILES['feature_img_url1']['type'];
    //     $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    //     // Проверка допустимых типов файлов
    //     $allowedFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
    //     if (in_array(strtolower($fileExtension), $allowedFileTypes)) {
    //         // Создаем уникальное имя файла
    //         $newFileName = uniqid('feature_', true) . '.' . $fileExtension;

    //         // Указываем директорию для загрузки
    //         $uploadDir = __DIR__ . '/../../uploads/home-images/';
    //         $destination = $uploadDir . $newFileName;

    //         // Перемещаем файл
    //         if (move_uploaded_file($fileTmpPath, $destination)) {
    //             $imagePath1 = '/uploads/home-images/' . $newFileName; // Путь для сохранения в базе данных
    //         } else {
    //             echo json_encode(['status' => 'error', 'message' => 'Не удалось переместить файл.']);
    //             exit;
    //         }
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Недопустимый тип файла.']);
    //         exit;
    //     }
    // }


    if ($uploadedImage1 !== null) {

        // uploadedImage1 (file) validation
        if (!empty($uploadedImage1)) {
            $types = ['image/jpeg', 'image/png'];

            // if file format which available using ['type'] key not exist than
            if (!in_array($uploadedImage1['type'], $types)) {
                setValidationError('uploadedImage1', 'Uploaded image for [Feature 1] has wrong type.');
            }

            if ($uploadedImage1['size'] / 1000000 >= 1) {
                setValidationError('uploadedImage1', 'Uploaded image for [Feature 1] must have less than 1 MB.');
            }
        }


        // ---====== FILE UPLOADING ======---
        // If everything is correct and file is not empty we'll upload it to uploads direction.
        if(!empty($uploadedImage1)) {

            $file = $uploadedImage1;

            // package where we will store files.
            $uploadsPackage = __DIR__ . '/../../../uploads';
            $uploadPath     = __DIR__ . '/../../../uploads/home-images';

            // if package not exist we'll create it.
            if (!is_dir($uploadsPackage)) {
                // path direction, permissions, recursive.
                mkdir($uploadsPackage, 0777, true); 
            }

            // if package not exist we'll create it.
            if (!is_dir($uploadPath)) { 
                // path direction, permissions, recursive.
                mkdir($uploadPath, 0777, true);
            }

            // getting the extension of that file (without dot).
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            // setting the file name.
            $fileName = 'feature-banner-1' . '_' . time() . ".$ext" ;
            // $fileName example: feature-banner-1_1731443492.png


            // uploading process.
            if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
                die('Error uploading file to server.');

                // We need to redirect this with some error message.
                // redirect('/admin/admin.php');  // user personal workspace 
            }

            // dynamic file full path
            // $uploadedImagePath1 = "uploads/home-images/$fileName";

            // we can return this path for example to store it in db.
            $uploadedImagePath1 = $fileName;
        }
        
    } else {
        $uploadedImagePath1 = "feature-banner-1.png";
    }


    // Получение соединения с базой данных через PDO
    $pdo = getPDO();


    // SQL-запрос для обновления данных
    $query = 
        "UPDATE home_page_content SET 
            feature_title1 = :feature_title1, 
            feature_descripton1 = :feature_descripton1, 
            feature_img_url1 = :feature_img_url1, 
            feature_item_1 = :feature_item_1, 
            feature_item_2 = :feature_item_2, 
            feature_item_3 = :feature_item_3, 
            feature_item_4 = :feature_item_4 
        WHERE id = 1";

    $params = [
        'feature_title1' => $featureTitle1,
        'feature_descripton1' => $featureDescription1,
        'feature_img_url1' => $uploadedImagePath1,
        'feature_item_1' => $featureItem1_1,
        'feature_item_2' => $featureItem1_2,
        'feature_item_3' => $featureItem1_3,
        'feature_item_4' => $featureItem1_4,
    ];

    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute($params);
        echo json_encode(['status' => 'success']);  // Ответ в формате JSON
    } catch (\Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        die($e->getMessage());
    }
}

