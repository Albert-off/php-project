<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    try {
        // SQL-query to delete order in orders db table.
        $query = "DELETE FROM orders WHERE order_state = 'DELETED' AND id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $orderId]);

        echo json_encode(['success' => true, 'message' => 'Order permanently deleted.']);

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
