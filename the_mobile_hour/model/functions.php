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

// product listing and search/filter
function getProducts($filters = [], $sort = '', $search = '', $limit = null) {
  global $pdo;
  $sql = 'SELECT p.product_id, p.product_name, p.price, i.image_url, p.manufacturer 
          FROM product p 
          JOIN images i ON p.product_id = i.product_id';
  $whereClauses = [];
  $params = [];

  if (!empty($filters['brand'])) {
      $whereClauses[] = 'p.manufacturer = :brand';
      $params['brand'] = $filters['brand'];
  }

  if (!empty($search)) {
      $whereClauses[] = 'p.product_name LIKE :search';
      $params['search'] = '%' . $search . '%';
  }

  if ($whereClauses) {
      $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
  }

  if (!empty($sort)) {
      if ($sort == 'name_asc') {
          $sql .= ' ORDER BY p.product_name ASC';
      } elseif ($sort == 'name_desc') {
          $sql .= ' ORDER BY p.product_name DESC';
      } elseif ($sort == 'price_asc') {
          $sql .= ' ORDER BY p.price ASC';
      } elseif ($sort == 'price_desc') {
          $sql .= ' ORDER BY p.price DESC';
      }
  }

  if ($limit !== null) {
      $sql .= ' LIMIT :limit';
      $stmt = $pdo->prepare($sql);
      foreach ($params as $key => $value) {
          $stmt->bindValue(':' . $key, $value);
      }
      $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
  } else {
      $stmt = $pdo->prepare($sql);
      foreach ($params as $key => $value) {
          $stmt->bindValue(':' . $key, $value);
      }
  }
  $stmt->execute();
  return $stmt->fetchAll();
}

//returns current list of brands
function getAllBrands() {
  global $pdo;
  $sql = 'SELECT DISTINCT manufacturer FROM product';
  $stmt = $pdo->query($sql);
  return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

