<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = $_POST['order_id'] ?? null;
    $orderStatus = !empty($_POST['order_status']) ? $_POST['order_status'] : 'NOT STARTED';


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    try {
        // SQL-query to set or update new order status in orders db table.
        $checkQuery = "SELECT COUNT(*) FROM orders WHERE id = :id";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute(['id' => $orderId]);
        $orderExists = $checkStmt->fetchColumn();
        
        if ($orderExists) {
            // Update the existin order
            $query = "UPDATE orders SET order_status = :order_status WHERE id = :id";
            
            $params = [
                'order_status' => $orderStatus,
                'id' => $orderId
            ];
        } else {
            // Insert a new order
            $query = "INSERT INTO orders (order_status) VALUES (:order_status)";

            $params = [
                'order_status' => $orderStatus
            ];
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);

        echo json_encode(["message" => "Data received and processed."]);

    } catch (\Exception $e) {
        // die($e->getMessage());
        echo json_encode(["error" => $e->getMessage()]);
        http_response_code(500); 
        exit;
    }
    
} else {
    echo json_encode(["error" => "Invalid request method."]);
    http_response_code(405); 
    exit;
}
