<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'] ?? null;
    $postStatus = !empty($_POST['post_status']) ? $_POST['post_status'] : 'PUBLISHED';


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    try {
        // SQL-query to set or update new post status in posts db table.
        $checkQuery = "SELECT COUNT(*) FROM posts WHERE id = :id";
        $checkStmt = $pdo->prepare($checkQuery);
        $checkStmt->execute(['id' => $postId]);
        $postExists = $checkStmt->fetchColumn();
        
        if ($postExists) {
            // Update the existin post
            $query = "UPDATE posts SET post_status = :post_status WHERE id = :id";
            
            $params = [
                'post_status' => $postStatus,
                'id' => $postId
            ];
        } else {
            // Insert a new post
            $query = "INSERT INTO posts (post_status) VALUES (:post_status)";

            $params = [
                'post_status' => $postStatus
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
