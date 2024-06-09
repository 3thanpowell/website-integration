<?php


require_once 'db.php';

// register a user
function registerUser($email, $password, $firstname, $lastname, $phone, $address, $postcode, $city, $state) {
    global $pdo;
    try {
        // start transaction
        $pdo->beginTransaction();

        // insert into user table
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO user (user_role, user_password) VALUES (:role, :password)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'role' => 'customer',
            'password' => $hashed_password
        ]);
        
        // get last inserted user_id
        $user_id = $pdo->lastInsertId();

        // insert into personal_info table
        $sql = 'INSERT INTO personal_info (user_id, firstname, lastname, user_phone, user_email, user_address, postcode, city, state) 
                VALUES (:user_id, :firstname, :lastname, :phone, :email, :address, :postcode, :city, :state)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $user_id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'postcode' => $postcode,
            'city' => $city,
            'state' => $state
        ]);

        // Commit transaction
        $pdo->commit();
        return true;
    } catch (PDOException $e) {
        // rollback transaction if error
        $pdo->rollBack();

        // check for duplicate email
        if ($e->getCode() == 23000) {
            return 'duplicate';
        } else {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}


//user-login verification and grabs info
function validateUser($email, $password) {
  global $pdo;
  
  $sql = 'SELECT u.user_id, u.user_role, p.user_email, u.user_password, p.firstname, p.lastname, p.user_phone, p.user_email, p.user_address, p.postcode, p.city, p.state, p.customer_id
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


//returns product details
function getProductById($product_id) {
    global $pdo;
    $sql = 'SELECT p.product_id, p.product_name, p.price, p.product_model, p.manufacturer, i.image_url, 
            f.weight, f.dimensions, f.OS, f.screensize, f.resolution, 
            f.CPU, f.RAM, f.storage, f.battery, f.rear_camera, f.front_camera, f.description
            FROM product p
            JOIN images i ON p.product_id = i.product_id
            JOIN feature f ON p.feature_id = f.feature_id
            WHERE p.product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    return $stmt->fetch();
}


//place order - !!quantity set to 1, change if implementing bulk ordr
function placeOrder($customerId, $productId, $priceSold) {
    global $pdo;

    try {
        // start transaction
        $pdo->beginTransaction();

        // insert into order table
        $sql = 'INSERT INTO `order` (order_date, customer_id, order_status) VALUES (NOW(), :customer_id, "Processing")';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['customer_id' => $customerId]);

        // last inserted order number
        $orderNumber = $pdo->lastInsertId();

        // insert into order_detail table
        $sql = 'INSERT INTO order_detail (product_id, quantity, price_sold, order_number) VALUES (:product_id, 1, :price_sold, :order_number)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'product_id' => $productId,
            'price_sold' => $priceSold,
            'order_number' => $orderNumber
        ]);

        // commit
        $pdo->commit();

        return true;
    } catch (Exception $e) {
        // rolback if error
        $pdo->rollBack();
        error_log("Order failed: " . $e->getMessage());
        return false;
    }
}


// gets 3 recent orders by customer_id
function getRecentOrders($customerId) {
    global $pdo;
    $sql = 'SELECT o.order_number, o.order_date, o.order_status, o.order_delivery_date, p.product_name, i.image_url
            FROM `order` o
            JOIN order_detail od ON o.order_number = od.order_number
            JOIN product p ON od.product_id = p.product_id
            JOIN images i ON p.product_id = i.product_id
            WHERE o.customer_id = :customer_id
            ORDER BY o.order_date DESC
            LIMIT 3';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['customer_id' => $customerId]);
    return $stmt->fetchAll();
}


// get all orders by customer_id - no limit
function getAllOrders($customerId) {
    global $pdo;
    $sql = 'SELECT o.order_number, o.order_date, o.order_status, o.order_delivery_date, p.product_name, i.image_url, p.product_id
            FROM `order` o
            JOIN order_detail od ON o.order_number = od.order_number
            JOIN product p ON od.product_id = p.product_id
            LEFT JOIN images i ON p.product_id = i.product_id
            WHERE o.customer_id = :customer_id
            ORDER BY o.order_date DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['customer_id' => $customerId]);
    return $stmt->fetchAll();
}


// cancel order - only if order status is 'Processing'
function cancelOrder($orderNumber) {
    global $pdo;
    $sql = 'UPDATE `order` SET order_status = "Cancelled" WHERE order_number = :order_number AND order_status = "Processing"';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['order_number' => $orderNumber]);
}


// customer update information
function updateUserInfo($userId, $email, $firstname, $lastname, $phone, $address, $postcode, $city, $state) {
    global $pdo;

    try {
        // check for duplicate email
        $sql = 'SELECT COUNT(*) FROM personal_info WHERE user_email = :email AND user_id != :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'user_id' => $userId]);
        if ($stmt->fetchColumn() > 0) {
            return 'duplicate';
        }

        // update user info
        $sql = 'UPDATE personal_info
                SET user_email = :email, firstname = :firstname, lastname = :lastname, user_phone = :phone,
                    user_address = :address, postcode = :postcode, city = :city, state = :state
                WHERE user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'address' => $address,
            'postcode' => $postcode,
            'city' => $city,
            'state' => $state,
            'user_id' => $userId
        ]);

        return $stmt->rowCount() > 0 ? true : false;
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            return 'duplicate';
        } else {
            error_log("Error: " . $e->getMessage());
            return false;
        }
    }
}





