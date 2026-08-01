<?php

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName   = $_POST['firstName']   ?? '[empty]';
    $lastName    = $_POST['lastName']    ?? '[empty]';
    $email       = $_POST['email']       ?? '[empty]';
    $phone       = $_POST['phone']       ?? '[empty]';
    $postalCode  = $_POST['postalCode']  ?? '[empty]';
    $address     = $_POST['address']     ?? '[empty]';
    $city        = $_POST['city']        ?? '[empty]';
    $location    = $_POST['location']    ?? '[empty]';

    $date = !empty($_POST['date']) ? $_POST['date'] : null;  // as we have empty string

    $time        = $_POST['time']        ?? '[empty]';
    $products    = $_POST['products']    ?? '[empty]';
    $comments    = $_POST['comments']    ?? '[empty]';
    

    // ---====== INTERACTION WITH DB ======---

    // $pdo variable now have connection to db.
    $pdo = getPDO();

    // SQL-query to create new order tuple in orders db table.
    $query = 
        "INSERT INTO orders (
            firstname, 
            lastname, 
            email, 
            phone, 
            postal_code, 
            address, 
            city, 
            location, 
            date, 
            time, 
            products, 
            comments
        ) 
        VALUES (
            :firstname, 
            :lastname, 
            :email, 
            :phone, 
            :postal_code, 
            :address, 
            :city, 
            :location, 
            :date, 
            :time, 
            :products, 
            :comments
        )
    ";

    $params = [
        'firstname'   => $firstName, 
        'lastname'    => $lastName, 
        'email'       => $email, 
        'phone'       => $phone, 
        'postal_code' => $postalCode, 
        'address'     => $address,
        'city'        => $city,
        'location'    => $location,
        'date'        => $date,
        'time'        => $time,
        'products'    => $products,
        'comments'    => $comments
    ];
    $stmt = $pdo->prepare($query);

    try {
        $stmt->execute($params);
    } catch (\Exception $e) {
        die($e->getMessage());
    }

    
    echo "Data received and processed.";
} else {
    echo "Invalid request method.";
}
