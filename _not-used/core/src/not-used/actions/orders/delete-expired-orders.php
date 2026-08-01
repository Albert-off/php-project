<?php

require_once __DIR__ . "/../../helpers.php";


// ---====== INTERACTION WITH DB ======---

// $pdo variable now have connection to db.
$pdo = getPDO();

try {
    // SQL-query to auto delete order in the orders db table if auto_delete_date has expired.
    $query = "DELETE FROM orders WHERE auto_delete_date <= NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Expired orders deleted successfully.']);
    } else {
        echo json_encode(['success' => true, 'message' => 'No expired orders to delete.']);
    }

} catch (\Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    http_response_code(500);
    exit;
}
