<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $flInstallTitle = $_POST['fl_install_title'];
    $flInstallDescr1 = $_POST['fl_install_descr_1'];
    $flInstallSubtitle = $_POST['fl_install_subtitle'];
    $flInstallDescr2 = $_POST['fl_install_descr_2'];

    $uploadedImage = $_FILES['fl_install_img_url'] ?? null;
    $uploadedImagePath = null;

    // Обработка загрузки файла
    // if (isset($_FILES['fl_install_img_url']) && $_FILES['fl_install_img_url']['error'] === UPLOAD_ERR_OK) {
    //     $fileTmpPath = $_FILES['fl_install_img_url']['tmp_name'];
    //     $fileName = $_FILES['fl_install_img_url']['name'];
    //     $fileSize = $_FILES['fl_install_img_url']['size'];
    //     $fileType = $_FILES['fl_install_img_url']['type'];
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


    if ($uploadedImage !== null) {

        // uploadedImage (file) validation
        if (!empty($uploadedImage)) {
            $types = ['image/jpeg', 'image/png'];

            // if file format which available using ['type'] key not exist than
            if (!in_array($uploadedImage['type'], $types)) {
                setValidationError('uploadedImage', 'Uploaded image for [Flooring Installation] has wrong type.');
            }

            if ($uploadedImage['size'] / 1000000 >= 1) {
                setValidationError('uploadedImage', 'Uploaded image for [Flooring Installation] must have less than 1 MB.');
            }
        }


        // ---====== FILE UPLOADING ======---
        // If everything is correct and file is not empty we'll upload it to uploads direction.
        if(!empty($uploadedImage)) {

            $file = $uploadedImage;

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
            $fileName = 'flooring-installation' . '_' . time() . ".$ext" ;
            // $fileName example: flooring-installation_1731443492.png


            // uploading process.
            if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
                die('Error uploading file to server.');

                // We need to redirect this with some error message.
                // redirect('/admin/admin.php');  // user personal workspace 
            }

            // dynamic file full path
            // $uploadedImagePath = "uploads/home-images/$fileName";

            // we can return this path for example to store it in db.
            $uploadedImagePath = $fileName;
        }
        
    } else {
        $uploadedImagePath = "flooring-installation.jpg";
    }


    // Получение соединения с базой данных через PDO
    $pdo = getPDO();


    // SQL-запрос для обновления данных
    $query = 
        "UPDATE fl_install_page_content SET 
            fl_install_title = :fl_install_title, 
            fl_install_descr_1 = :fl_install_descr_1, 
            fl_install_img_url = :fl_install_img_url, 
            fl_install_subtitle = :fl_install_subtitle, 
            fl_install_descr_2 = :fl_install_descr_2
        WHERE id = 1";

    $params = [
        'fl_install_title' => $flInstallTitle,
        'fl_install_descr_1' => $flInstallDescr1,
        'fl_install_img_url' => $uploadedImagePath,
        'fl_install_subtitle' => $flInstallSubtitle,
        'fl_install_descr_2' => $flInstallDescr2
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

