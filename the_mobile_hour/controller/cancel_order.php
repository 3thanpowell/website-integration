<?php
session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
  header('Location: ../view/login.php');
  exit();
}

require_once '../model/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $orderNumber = $_POST['order_number'];
  cancelOrder($orderNumber);
  header('Location: ../view/order_history.php');
  exit();
}
