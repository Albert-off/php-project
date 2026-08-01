<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    try {
        // SQL-query to update order state in orders db table.
        $query = "UPDATE orders SET order_state = 'ACTIVE' WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $orderId]);

        echo json_encode(['success' => true, 'message' => 'Data received and processed.']);

    } catch (\Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
        http_response_code(500); 
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    http_response_code(405); 
    exit;
}
