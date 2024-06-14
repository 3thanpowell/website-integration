<?php
session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
  header('Location: ../view/login.php');
  exit();
}

require_once '../model/functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_product_id'])) {
  $customerId = $_SESSION['customer_id'];
  $productId = $_POST['order_product_id'];
  $priceSold = $_POST['price'];

  if (placeOrder($customerId, $productId, $priceSold)) {
    header('Location: ../view/order_success.php');
    exit();
  } else {
    header('Location: ../view/order_failed.php');
    exit();
  }
}
