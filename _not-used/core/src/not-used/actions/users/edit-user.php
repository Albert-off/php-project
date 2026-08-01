<?php

// Always start session in the first line.
session_start();

require_once __DIR__ . "/../../helpers.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // We move data from the global array variable $_POST into separate variables.
    // We have to check them to avoid warning that some field is not existed.
    $userId = $_POST['userId'] ?? null;
    $originalEmail = $_POST['originalEmail'] ?? null;
    $originalAvatarPath = $_POST['originalAvatarPath'] ?? null;

    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null ;
    $passwordConfirmation = $_POST['password-confirmation'] ?? null;
    
    $role = $_POST['role'] ?? 'User';
    
    // To get file we have to use global array variable $_FILES.
    $avatar = $_FILES['avatar'] ?? null;
    $avatarPath = null;
    
    
    // ---====== VALIDATION ======---
    
    // name
    if (empty($name)) {
        setValidationError('name', 'Name is required');
    } elseif (strlen($name) <= 2) {
        setValidationError('name', 'Name should have at least 3 characters');
    }
    
    // email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setValidationError('email', 'Incorrect email specified');
    } elseif ($email !== $originalEmail) {
        if (!isEmailUnique($email)) {
            setValidationError('email', 'User with provided email already exist');
        }
    }
    
    // password
    if (empty($password)) {
        setValidationError('password', 'Passowrd is required');
    } elseif (strlen($name) <= 2) {
        setValidationError('password', 'Passowrd should have at least 5 unique characters');
    } elseif ($password !== $passwordConfirmation) {
        setValidationError('password', 'Passwords do not match');
    }
    
    // password confirmation
    if (empty($passwordConfirmation)) {
        setValidationError('password-confirmation', 'Please repeat the password');
    }
    
    // avatar (file)
    if (isset($avatar) && $avatar['error'] === UPLOAD_ERR_NO_FILE) {
        // If $avatar is empty we won't change the original file path.
        $avatarPath = $originalAvatarPath;
        // setValidationError('avatar', 'Arajinica');

    } elseif (isset($avatar) && $avatar['error'] === UPLOAD_ERR_OK) {
        $types = ['image/jpeg', 'image/png'];
    
        // if file format which available using ['type'] key not exist than
        if (!in_array($avatar['type'], $types)) {
            setValidationError('avatar', 'Profile image has wrong type');
        }
    
        if ($avatar['size'] / 1000000 >= 1) {
            setValidationError('avatar', 'Profile image must have less than 1 MB');
        }
    }
    
    
    // If the list with validation errors is not empty, then we redirect back to the form.
    if (!empty($_SESSION['validation'])) {
        // Storing old values to send it back.
        setOldValue('name', $name);
        setOldValue('email', $email);
    
        // redirect to a user upadate page using custom function in helper.php
        redirect('/admin/users/edit.php?id=' . $userId);
    }
    
    
    // ---====== FILE UPLOADING ======---
    
    // If everything is correct and file is not empty we'll upload it to uploads direction.
    // Otherwise if file is empty this code block will be ignored.
    if ($avatarPath !== $originalAvatarPath) {
        if (isset($avatar) && $avatar['error'] === UPLOAD_ERR_OK) {
            $avatarPath = uploadFile($avatar, 'avatar');
        }
    }

    
    // ---====== INTERACTION WITH DB ======---
    
    // $pdo variable now have connection to db.
    $pdo = getPDO();
    
    // Now we can save our user in db (using default construction for this).
    $query = 
        "UPDATE users SET 
            name = :name, 
            email = :email, 
            role = :role, 
            avatar = :avatar, 
            password = :password
        WHERE id = :id";
    
    $params = [
        'name' => $name, 
        'email' => $email, 
        'role' => $role, 
        'avatar' => $avatarPath, 
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'id' => $userId
    ];
    $stmt = $pdo->prepare($query);
    
    try {
        $stmt->execute($params);
    } catch (\Exception $e) {
        die($e->getMessage());
    }
    
    redirect('/admin/users/index.php');
}