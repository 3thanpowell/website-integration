<?php
session_start();

// kicks user if not logged in or not manager
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'manager') {
  header('Location: ../view/login.php');
  exit();
}

require_once '../model/functions.php';

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id == 0) {
  header('Location: ../view/edit_user.php?status=error&id=' . $user_id);
  exit();
}

if (demoteUserToCustomer($user_id)) {
  header('Location: ../view/edit_user.php?status=demoted&id=' . $user_id);
  exit();
} else {
  header('Location: ../view/edit_user.php?status=error&id=' . $user_id);
  exit();
}
