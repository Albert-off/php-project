<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $featureTitle2 = $_POST['feature_title2'];
    $featureDescription2 = $_POST['feature_descripton2'];
    $featureItem2_1 = $_POST['feature_item2_1'];
    $featureItem2_2 = $_POST['feature_item2_2'];
    $featureItem2_3 = $_POST['feature_item2_3'];
    $featureItem2_4 = $_POST['feature_item2_4'];

    $uploadedImage2 = $_FILES['feature_img_url2'] ?? null;
    $uploadedImagePath2 = null;

    // Обработка загрузки файла
    // if (isset($_FILES['feature_img_url2']) && $_FILES['feature_img_url2']['error'] === UPLOAD_ERR_OK) {
    //     $fileTmpPath = $_FILES['feature_img_url2']['tmp_name'];
    //     $fileName = $_FILES['feature_img_url2']['name'];
    //     $fileSize = $_FILES['feature_img_url2']['size'];
    //     $fileType = $_FILES['feature_img_url2']['type'];
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


    if ($uploadedImage2 !== null) {

        // uploadedImage2 (file) validation
        if (!empty($uploadedImage2)) {
            $types = ['image/jpeg', 'image/png'];

            // if file format which available using ['type'] key not exist than
            if (!in_array($uploadedImage2['type'], $types)) {
                setValidationError('uploadedImage2', 'Uploaded image for [Feature 1] has wrong type.');
            }

            if ($uploadedImage2['size'] / 1000000 >= 1) {
                setValidationError('uploadedImage2', 'Uploaded image for [Feature 1] must have less than 1 MB.');
            }
        }


        // ---====== FILE UPLOADING ======---
        // If everything is correct and file is not empty we'll upload it to uploads direction.
        if(!empty($uploadedImage2)) {

            $file = $uploadedImage2;

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

            // we can return this path for example to store it in db.
            $uploadedImagePath2 = "uploads/home-images/$fileName";
        }
        
    } else {
        $uploadedImagePath2 = "feature-banner-1.png";
    }


    // Получение соединения с базой данных через PDO
    $pdo = getPDO();


    // SQL-запрос для обновления данных
    $query = 
        "UPDATE home_page_content SET 
            feature_title2 = :feature_title2, 
            feature_descripton2 = :feature_descripton2, 
            feature_img_url2 = :feature_img_url2, 
            feature_item2_1 = :feature_item2_1, 
            feature_item2_2 = :feature_item2_2, 
            feature_item2_3 = :feature_item2_3, 
            feature_item2_4 = :feature_item2_4 
        WHERE id = 1";

    $params = [
        'feature_title2' => $featureTitle2,
        'feature_descripton2' => $featureDescription2,
        'feature_img_url2' => $uploadedImagePath2,
        'feature_item2_1' => $featureItem2_1,
        'feature_item2_2' => $featureItem2_2,
        'feature_item2_3' => $featureItem2_3,
        'feature_item2_4' => $featureItem2_4,
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

