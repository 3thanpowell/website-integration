<?php
require_once '../model/functions.php';
session_start();
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
