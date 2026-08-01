<?php

session_start();


require_once __DIR__ . "/../helpers.php";


$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;


// Storing old values to send it back.
setOldValue('email', $email);


// If the condition is false, we do not execute the subsequent code.
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    setValidationError('email', 'Invalid email');
    setMessage('error', 'Validation error');
    redirect('/auth.php');
}


$user = findUser($email);


// If our user not exist.
if (!$user) {
    setMessage('error', "User $email not found");
    redirect('/auth.php');
}


// Password decryption.
if (!password_verify($password, $user['password'])) {
    setMessage('error', "Incorrect password");
    redirect('/auth.php');
}


// Authorization was successful.
// In the user field we can place the ID of the currently authorized user, 
// and this will be an indicator of which user is currently present in the current session.
$_SESSION['user']['id'] = $user['id'];

redirect('/admin/admin.php');  // user personal workspace 