<?php

//processes login form data

session_start();
require_once '../model/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $user = validateUser($email, $password);
    if ($user) {

        // store user information in the session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_role'] = $user['user_role'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['user_phone'] = $user['user_phone'];
        $_SESSION['user_address'] = $user['user_address'];
        $_SESSION['postcode'] = $user['postcode'];
        $_SESSION['city'] = $user['city'];
        $_SESSION['state'] = $user['state'];
        $_SESSION['customer_id'] = $user['customer_id'];

        // redirect based on role
        if ($user['user_role'] === 'admin' || $user['user_role'] === 'manager') {

            header('Location: ../view/staff_dashboard.php');
        } else {

            header('Location: ../view/dashboard.php');
        }
        exit();
    } else {
        // handle login failure
        header('Location: ../view/login.php?error=invalid_credentials');
        exit();
    }
}
