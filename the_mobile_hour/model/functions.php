<?php

//user-login verification
require_once 'db.php';

function validateUser($email, $password) {
  global $pdo;
  $sql = 'SELECT u.user_id, u.user_role, p.user_email, u.user_password, p.firstname
          FROM user u
          JOIN personal_info p ON u.user_id = p.user_id
          WHERE p.user_email = :email';

  $stmt = $pdo->prepare($sql);
  $stmt->execute(['email' => $email]);
  $user = $stmt->fetch();

  error_log("Fetched User: " . print_r($user, true));


  if ($user && password_verify($password, $user['user_password'])) {
    return $user;
  }
  return false;
}

// logout destroy session
function logoutUser() {
  session_start();
  session_unset();
  session_destroy();
  header('Location: ../view/login.php');
  exit;
}

// index product lists
function getProducts($limit = 8) {
  global $pdo;
  $sql = 'SELECT p.product_id, p.product_name, p.price, i.image_url 
          FROM product p 
          JOIN images i ON p.product_id = i.product_id 
          LIMIT :limit';
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchAll();
}
