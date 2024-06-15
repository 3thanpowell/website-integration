<?php
session_start();

// Kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id == 0) {
  header('Location: ../view/manage_products.php');
  exit();
}

if (deleteProduct($product_id)) {
  header('Location: ../view/manage_products.php?status=deleted');
  exit();
} else {
  header('Location: ../view/manage_products.php?status=error');
  exit();
}
