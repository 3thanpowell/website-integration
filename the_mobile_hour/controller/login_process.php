<?php

//processes login form data

require_once '../model/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    $user = validateUser($email, $password);

    

    if ($user) {
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['role'] = $user['user_role'];
      $_SESSION['user_email'] = $user['user_email'];
      $_SESSION['firstname'] = $user['firstname'];

      //redirect to dash
     switch ($user['user_role']) {
      case 'admin':
        header('Location: ../view/admin_dashboard.php');
        break;
        
      case 'manager':
        header('Location: ../view/manager_dashboard.php');
        break;

      default:
        header('Location: ../view/dashboard.php');
        break;
      
      }
      exit;

    } else {
      header('Location: ../view/login.php?error=1');
      exit;
    }   

  } else {
    header('Location: ../view/login.php');
    exit;
  }