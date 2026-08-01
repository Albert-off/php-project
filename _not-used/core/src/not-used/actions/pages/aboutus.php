<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $aboutusTitle = $_POST['aboutus_title'];
    $aboutusDescr1 = $_POST['aboutus_descr_1'];
    $aboutusSubtitle = $_POST['aboutus_subtitle'];
    $aboutusDescr2 = $_POST['aboutus_descr_2'];


    // Получение соединения с базой данных через PDO
    $pdo = getPDO();
    

    // SQL-запрос для обновления данных
    $query = 
        "UPDATE aboutus_page_content SET 
            aboutus_title = :aboutus_title, 
            aboutus_descr_1 = :aboutus_descr_1,
            aboutus_subtitle = :aboutus_subtitle, 
            aboutus_descr_2 = :aboutus_descr_2
        WHERE id = 1";

    $params = [
        'aboutus_title' => $aboutusTitle,
        'aboutus_descr_1' => $aboutusDescr1,
        'aboutus_subtitle' => $aboutusSubtitle,
        'aboutus_descr_2' => $aboutusDescr2
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

