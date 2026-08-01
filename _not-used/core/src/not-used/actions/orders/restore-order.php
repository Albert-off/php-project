<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    try {
        $pdo->beginTransaction();

        // SQL-query to update order state in orders db table.
        $query = "UPDATE orders SET order_state = 'ACTIVE' WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $orderId]);

        // Removing auto-delete date 90 days
        $query = "UPDATE orders SET auto_delete_date = NULL WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $orderId]);

        $pdo->commit();

        echo json_encode(['success' => true, 'message' => 'Data received and processed.']);

    } catch (\Exception $e) {
        $pdo->rollBack();

        echo json_encode(["error" => $e->getMessage()]);
        http_response_code(500); 
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    http_response_code(405); 
    exit;
}
