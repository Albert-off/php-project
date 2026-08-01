<?php

// Always start session in the first line.
session_start();

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId      = $_POST['postId']      ?? null;
    $title       = $_POST['title']       ?? null;
    $description = $_POST['description'] ?? null;
    $status      = $_POST['post_status'] ?? 'PUBLISHED'; 

    // Image files
    $postImages = $_FILES['post-images'] ?? null;
    $imagePaths = [];


    // ---====== VALIDATION ======---
    
    // description
    if (empty($description)) {
        setValidationError('description', 'Description is required');
    } 
    // elseif (strlen($description) < 50) {
    //     setValidationError('description', 'Description is too short [min 50 characters required]');
    // }

    // post-images (files)
    if (!empty($postImages)) {
        $types = ['image/jpeg', 'image/png'];

        foreach ($postImages['type'] as $type) {
            if (!in_array($type, $types)) {
                setValidationError('post-images', 'One or more images have an invalid type');
                break;
            }
        }

        foreach ($postImages['size'] as $size) {
            if ($size / 1000000 >= 1) {
                setValidationError('post-images', 'One or more iamges exceed the size limit of 1 MB');
                break;
            }
        }
    }


    // If the list with validation errors is not empty, then we redirect back to the form.
    if (!empty($_SESSION['validation'])) {
        // Storing old values to send it back.
        setOldValue('title', $title);
        setOldValue('description', $description);
    
        // redirect to a registration page using custom function in helper.php
        redirect('/admin/posts/edit.php?id=' . $postId);
    }


    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    // SQL-query to create new order tuple in posts db table.
    $query = 
        "UPDATE posts SET
            title = :title, 
            description = :description,
            post_status = :post_status
        WHERE id = :id
    ";

    $params = [
        'title'       => $title, 
        'description' => $description,
        'post_status' => $status,
        'id'          => $postId
    ];
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute($params);
    } catch (\Exception $e) {
        die($e->getMessage());
    }



    // ---====== FILE UPLOADING ======---

    if (!empty($postImages['name'][0])) {

        // Deleting old images
        $query = "SELECT image_path FROM posts_images WHERE post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['post_id' => $postId]);
        $oldImages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($oldImages as $oldImage) {
            if (file_exists(__DIR__ . '/../../public/' . $oldImage['image_path'])) {
                unlink(__DIR__ . '/../../public/' . $oldImage['image_path']);
            }
        }

        $query = "DELETE FROM posts_images WHERE post_id = :post_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['post_id' => $postId]);



        // --- Posts files uploading function ---
        function uploadPostFile(array $file, string $prefix = ''): string
        {
            // package where we will store files.
            $uploadPath = __DIR__ . '/../../../uploads/posts_images';

            // If package doesn't exist we'll create it.
            if(!is_dir($uploadPath)) {
                // path direction, permissions, recursive
                mkdir($uploadPath, 0777, true);
            }

            // getting the extension of that file (without dot).
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

            // setting the file name.
            $fileName = $prefix . '_' . time() . ".$ext" ;
            // $fileName example: avatar_1731443492.png


            // uploading process.
            if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName")) {
                die('Error uploading file to server.');

                // We need to redirect this with some error message
            }

            // we can return this path for example to store it in db.
            return "uploads/posts_images/$fileName";
        }

        // --- Uploading new images ---
        foreach ($postImages['tmp_name'] as $key => $tmpName) {
            
            $file = [
                'name' => $postImages['name'][$key],
                'type' => $postImages['type'][$key],
                'tmp_name' => $tmpName,
                'error' => $postImages['error'][$key],
                'size' => $postImages['size'][$key],
            ];

            $imagePath = uploadPostFile($file, 'post_image');
            $imagePaths[] = $imagePath;


            // --- Saving new paths to iamge in Data Base ---
            $query = 
                "INSERT INTO posts_images (
                    post_id, 
                    image_path
                )
                VALUES (
                    :post_id,
                    :image_path
                )
            ";

            foreach ($imagePaths as $imagePath) {
                $params = [
                    'post_id' => $postId,
                    'image_path' => $imagePath
                ];
                $stmt = $pdo->prepare($query);

                try {
                    $stmt->execute($params);
                } catch (\Exception $e) {
                    die("Error saving iamge paths: " . $e->getMessage());
                }
            }
        }
    }

    
    echo "Data received and processed.";

    redirect('/admin/posts/index.php');

} else {
    echo "Invalid request method.";
}
