<?php

// Data sended by cURL  |  Comment out keys with values to simulate their absence.
$testdata = [
    "firstName"   => 'firstname',
    "lastName"    => 'lastname',
    "email"       => 'email@test.com',
    "phone"       => '+8743545679',
    // "postalCode"  => '90032',
    // "address"     => 'test address',
    // "city"        => 'Moscow',
    // "location"    => 'AB',
    "date"        => '',
    "time"        => 'Afternoon',
    "products"    => 'Carpet, Vinyl, Tile, Wool Carpet, Luxury Vinyl, Laminate',
    "comments"    => 'Some comment for test'
];


require_once __DIR__ . "../../../src/helpers.php";

$firstName  = $testdata['firstName']    ?? '[empty]';
$lastName   = $testdata['lastName']     ?? '[empty]';
$email      = $testdata['email']        ?? '[empty]';
$phone      = $testdata['phone']        ?? '[empty]';
$postalCode = $testdata['postalCode']   ?? '[empty]';
$address    = $testdata['address']      ?? '[empty]';
$city       = $testdata['city']         ?? '[empty]';
$location   = $testdata['location']     ?? '[empty]';

$date       = !empty($testdata['date']) ? $testdata['date'] : null;  // as we have empty string

$time       = $testdata['Afternoon']    ?? '[empty]';
$products   = $testdata['products']     ?? '[empty]';
$comments   = $testdata['comments']     ?? '[empty]';


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