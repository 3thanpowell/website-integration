<?php
session_start();

// Kicks user if not logged in or not a manager/admin
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: ../view/login.php');
  exit();
}

require_once '../model/functions.php';

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id == 0) {
  header('Location: ../view/manage_users.php?status=error');
  exit();
}

if (deleteUser($user_id)) {
  header('Location: ../view/manage_users.php?status=deleted');
  exit();
} else {
  header('Location: ../view/manage_users.php?status=error');
  exit();
}
