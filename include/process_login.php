<?php
include_once 'connect-db.php';
include_once 'loginfunction.php';
 
session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // The hashed password.
    $mysqli   = pr_connect();
    $step = login($username, $password, $mysqli); 
    if ($step == 2) {
        // Login success 
        header('Location: /');

    } else {
        // Login failed 
        header('Location: /login.php?error='.$step);
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request</br>';
    echo 'p='.$_POST['p'];
    echo $_POST['username'];
}

echo $step.'</br>'.$password.'</br>'.$username;