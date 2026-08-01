<?php
session_start();

require_once __DIR__ . '/../helpers.php';


// When we write the URL domain/src/actions/logout.php, the logout process occurs.
// To prevent this, we can use the global variable $_SERVER with the REQUEST_METHOD,
// which tells us which request method we are currently accessing a particular page.

// When we do this by URL, we use a GET request.
// var_dump($_SERVER['REQUEST_METHOD']);

// That means that we can use this condition to check that we use POST request.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}

// Otherwise we will redirect it.
redirect('/');
