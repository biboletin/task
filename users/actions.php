<?php

include 'functions.php';
include 'config.php';

if (isset($_GET['form']) && $_GET['form'] === 'register') {
    $username = validate($_POST['username']);
    $email = validate($_POST['email']);
    $password = hashPassword($_POST['password']);

$mysqli->sqlQuery("INSERT INTO users (`username`, `email`, `password`) 
    VALUES
      ('" . $username . "', '" . $email . "', '" . $password . "') ");

    header('Location: index.php');

}

if (isset($_GET['form']) && $_GET['form'] === 'login') {
    $username = validate($_POST['username']);
error_log($username);
    $password = $_POST['password'];

    $result = $mysqli->sqlQuery("SELECT 
                                `password`
                                FROM
                                users 
                                WHERE `username` = '" . $username . "'");
    $data = array_shift($result);
    if (empty($data)) {
        $_SESSION['error_message'] = 'Invalid username/password!';
        header('Location: index.php');
    }
    echo $password;
    echo '<br/>';
    echo $data['password'];
    if (password_verify($password, $data['password'])) {
        $_SESSION['error_message'] = '';
        $_SESSION['is_logged_in'] = LOGGED_IN;
        header('Location: Dashboard.php');
    }
    // error_log(print_r($user, true));
    // header('Location: index.php');

}