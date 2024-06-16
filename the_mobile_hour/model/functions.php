<?php

require_once 'db.php';

// all - register user
function registerUser($email, $password, $firstname, $lastname, $phone, $address, $postcode, $city, $state)
{
  global $pdo;
  try {
    $pdo->beginTransaction();

    // insert - user table
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO user (user_role, user_password) VALUES (:role, :password)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'role' => 'customer',
      'password' => $hashed_password
    ]);

    // get last inserted user_id
    $user_id = $pdo->lastInsertId();

    // insert - personal_info table
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

    $pdo->commit();
    return true;
  } catch (PDOException $e) {
    $pdo->rollBack();

    // check for duplicate email - 23000 sql code for integrity violation
    if ($e->getCode() == 23000) {
      return 'duplicate';
    } else {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
}


//all - user login validation
function validateUser($email, $password)
{
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


// all - logout
function logoutUser()
{
  session_start();
  session_unset();
  session_destroy();
  header('Location: ../view/login.php');
  exit;
}


// all - product filters and search
function getProducts($filters = [], $sort = '', $search = '', $limit = null)
{
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


//all - get brands
function getAllBrands()
{
  global $pdo;
  $sql = 'SELECT DISTINCT manufacturer FROM product';
  $stmt = $pdo->query($sql);
  return $stmt->fetchAll(PDO::FETCH_COLUMN);
}


//all - get product by id
function getProductById($product_id)
{
  global $pdo;
  $sql = 'SELECT p.product_id, p.product_name, p.price, p.product_model, p.manufacturer, p.stock_on_hand, i.image_url, 
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


//customer - place order (only 1, change on bulk order implementation)
function placeOrder($customerId, $productId, $priceSold)
{
  global $pdo;

  try {
    $pdo->beginTransaction();

    // insert - order table
    $sql = 'INSERT INTO `order` (order_date, customer_id, order_status) VALUES (NOW(), :customer_id, "Processing")';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['customer_id' => $customerId]);

    // last inserted order number
    $orderNumber = $pdo->lastInsertId();

    // insert - order_detail 
    $sql = 'INSERT INTO order_detail (product_id, quantity, price_sold, order_number) VALUES (:product_id, 1, :price_sold, :order_number)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'product_id' => $productId,
      'price_sold' => $priceSold,
      'order_number' => $orderNumber
    ]);


    $pdo->commit();

    return true;
  } catch (Exception $e) {
    $pdo->rollBack();
    error_log("Order failed: " . $e->getMessage());
    return false;
  }
}


// customer - get 3 recent orders by customer_id
function getRecentOrders($customerId)
{
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


// customer - get all orders by customer_id
function getAllOrders($customerId)
{
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


// customer - cancel order
function cancelOrder($orderNumber)
{
  global $pdo;
  $sql = 'UPDATE `order` SET order_status = "Cancelled" WHERE order_number = :order_number AND order_status = "Processing"';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['order_number' => $orderNumber]);
}


// customer - update information
function updateUserInfo($userId, $email, $firstname, $lastname, $phone, $address, $postcode, $city, $state)
{
  global $pdo;

  try {
    // check for duplicate email
    $sql = 'SELECT COUNT(*) FROM personal_info WHERE user_email = :email AND user_id != :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'user_id' => $userId]);
    if ($stmt->fetchColumn() > 0) {
      return 'duplicate';
    }

    // update - user info
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



// STAFF - FUNCTIONS

// STAFF - USER MANAGEMENT

// staff(manager) - get all users
function getAllUsers($filters = [], $sort = '', $search = '')
{
  global $pdo;
  $sql = 'SELECT u.user_id, u.user_role, p.user_email, p.firstname, p.lastname
            FROM user u
            JOIN personal_info p ON u.user_id = p.user_id';
  $whereClauses = [];
  $params = [];

  if (!empty($filters['role'])) {
    $whereClauses[] = 'u.user_role = :role';
    $params['role'] = $filters['role'];
  }

  if (!empty($search)) {
    $whereClauses[] = '(p.user_email LIKE :searchEmail OR p.firstname LIKE :searchFirstname OR p.lastname LIKE :searchLastname)';
    $params['searchEmail'] = '%' . $search . '%';
    $params['searchFirstname'] = '%' . $search . '%';
    $params['searchLastname'] = '%' . $search . '%';
  }


  if ($whereClauses) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
  }

  if (!empty($sort)) {
    if ($sort == 'name_asc') {
      $sql .= ' ORDER BY p.firstname ASC, p.lastname ASC';
    } elseif ($sort == 'name_desc') {
      $sql .= ' ORDER BY p.firstname DESC, p.lastname DESC';
    }
  }

  $stmt = $pdo->prepare($sql);

  if (!empty($params)) {
    foreach ($params as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
  }

  $stmt->execute();
  return $stmt->fetchAll();
}


// staff(manager) - promote customer to admin
function promoteUserToAdmin($user_id)
{
  global $pdo;
  $sql = 'UPDATE user SET user_role = :role WHERE user_id = :user_id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['role' => 'admin', 'user_id' => $user_id]);
}

// demote admin to customer (manager only)
function demoteUserToCustomer($user_id)
{
  global $pdo;
  try {
    $sql = 'UPDATE user SET user_role = "customer" WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    return true;
  } catch (PDOException $e) {
    return false;
  }
}


// staff(admin) - get only customers
function getCustomers($filters = [], $sort = '', $search = '')
{
  global $pdo;
  $sql = 'SELECT u.user_id, u.user_role, p.user_email, p.firstname, p.lastname
            FROM user u
            JOIN personal_info p ON u.user_id = p.user_id
            WHERE u.user_role = "customer"';
  $whereClauses = [];
  $params = [];

  if (!empty($search)) {
    $whereClauses[] = '(p.user_email LIKE :searchEmail OR p.firstname LIKE :searchFirstname OR p.lastname LIKE :searchLastname)';
    $params['searchEmail'] = '%' . $search . '%';
    $params['searchFirstname'] = '%' . $search . '%';
    $params['searchLastname'] = '%' . $search . '%';
  }


  if ($whereClauses) {
    $sql .= ' AND ' . implode(' AND ', $whereClauses);
  }

  if (!empty($sort)) {
    if ($sort == 'name_asc') {
      $sql .= ' ORDER BY p.firstname ASC, p.lastname ASC';
    } elseif ($sort == 'name_desc') {
      $sql .= ' ORDER BY p.firstname DESC, p.lastname DESC';
    }
  }

  $stmt = $pdo->prepare($sql);

  if (!empty($params)) {
    foreach ($params as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }
  }

  $stmt->execute();
  return $stmt->fetchAll();
}



// staff - get user by id
function getUserById($user_id)
{
  global $pdo;
  $sql = 'SELECT u.user_id, u.user_role, p.user_email, p.firstname, p.lastname, p.user_phone, p.user_address, p.postcode, p.city, p.state
            FROM user u
            JOIN personal_info p ON u.user_id = p.user_id
            WHERE u.user_id = :user_id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['user_id' => $user_id]);
  return $stmt->fetch();
}


// update - user 
function updateUser($user_id, $email, $firstname, $lastname, $phone, $address, $postcode, $city, $state)
{
  global $pdo;

  try {
    $pdo->beginTransaction();

    $sql1 = 'UPDATE personal_info SET user_email = :email, firstname = :firstname, lastname = :lastname, user_phone = :phone, user_address = :address, postcode = :postcode, city = :city, state = :state WHERE user_id = :user_id';
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(['email' => $email, 'firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone, 'address' => $address, 'postcode' => $postcode, 'city' => $city, 'state' => $state, 'user_id' => $user_id]);

    $pdo->commit();
    return true;
  } catch (PDOException $e) {
    $pdo->rollBack();
    if ($e->getCode() == 23000) {
      return 'duplicate';
    } else {
      return false;
    }
  }
}

// delete - user
function deleteUser($user_id)
{
  global $pdo;
  try {
    $pdo->beginTransaction();

    $sql1 = 'DELETE FROM personal_info WHERE user_id = :user_id';
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute(['user_id' => $user_id]);

    $sql2 = 'DELETE FROM user WHERE user_id = :user_id';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute(['user_id' => $user_id]);

    $pdo->commit();
    return true;
  } catch (PDOException $e) {
    $pdo->rollBack();
    return false;
  }
}


// STAFF - ORDER MANAGEMENT

// staff - get orders
function getUserOrders($filters = [], $search = '')
{
  global $pdo;
  $sql = 'SELECT o.order_number, o.order_date, o.order_status, o.order_delivery_date, o.customer_id, p.user_email
            FROM `order` o
            JOIN personal_info p ON o.customer_id = p.customer_id';
  $whereClauses = [];
  $params = [];

  if (!empty($filters['status'])) {
    $whereClauses[] = 'o.order_status = :status';
    $params['status'] = $filters['status'];
  }

  if (!empty($search)) {
    $whereClauses[] = '(p.user_email LIKE :searchEmail OR p.customer_id LIKE :searchCustomerId)';
    $params['searchEmail'] = '%' . $search . '%';
    $params['searchCustomerId'] = '%' . $search . '%';
  }

  if ($whereClauses) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
  }

  $sql .= ' ORDER BY o.order_date DESC';

  $stmt = $pdo->prepare($sql);
  foreach ($params as $key => $value) {
    $stmt->bindValue(':' . $key, $value);
  }
  $stmt->execute();
  return $stmt->fetchAll();
}

// update - order status
function updateOrderStatus($orderNumber, $status)
{
  global $pdo;
  $sql = 'UPDATE `order` SET order_status = :status, order_delivery_date = :deliveryDate WHERE order_number = :orderNumber';
  $stmt = $pdo->prepare($sql);
  $deliveryDate = ($status == 'Delivered') ? date('Y-m-d H:i:s') : null;
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':deliveryDate', $deliveryDate);
  $stmt->bindParam(':orderNumber', $orderNumber);
  return $stmt->execute();
}

// STAFF - INVENTORY MANAGEMENT

// staff - inventory products
function getProductsForInventory($search = '')
{
  global $pdo;
  $sql = 'SELECT product_id, product_name, manufacturer, stock_on_hand FROM product';

  if (!empty($search)) {
    $sql .= ' WHERE product_id LIKE :searchID OR product_name LIKE :searchName OR manufacturer LIKE :searchManufacturer';
  }

  $stmt = $pdo->prepare($sql);

  if (!empty($search)) {
    $stmt->bindValue(':searchID', '%' . $search . '%');
    $stmt->bindValue(':searchName', '%' . $search . '%');
    $stmt->bindValue(':searchManufacturer', '%' . $search . '%');
  }

  $stmt->execute();
  return $stmt->fetchAll();
}


// staff - update stock count
function updateStock($product_id, $amount, $action)
{
  global $pdo;
  try {
    $pdo->beginTransaction();

    // get current stock
    $sql = 'SELECT stock_on_hand FROM product WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    $product = $stmt->fetch();

    if ($product) {
      $current_stock = $product['stock_on_hand'];
      if ($action == 'add') {
        $new_stock = $current_stock + $amount;
      } elseif ($action == 'subtract') {
        $new_stock = $current_stock - $amount;
        if ($new_stock < 0) {
          throw new Exception('Stock cannot be negative');
        }
      }

      // update - stock
      $sql = 'UPDATE product SET stock_on_hand = :new_stock WHERE product_id = :product_id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['new_stock' => $new_stock, 'product_id' => $product_id]);

      // most recent date_created for product
      $sql = 'SELECT date_created FROM changelog WHERE product_id = :product_id ORDER BY date_created DESC LIMIT 1';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['product_id' => $product_id]);
      $last_date_created = $stmt->fetchColumn();

      // insert - changelog entry
      $sql = 'INSERT INTO changelog (product_id, date_created, date_last_modified, user_id) 
                    VALUES (:product_id, NOW(), :last_date_created, :user_id)';
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        'product_id' => $product_id,
        'last_date_created' => $last_date_created,
        'user_id' => $_SESSION['user_id']
      ]);

      $pdo->commit();
      return true;
    } else {
      throw new Exception('Product not found');
    }
  } catch (Exception $e) {
    error_log('Error updating stock: ' . $e->getMessage());
    $pdo->rollBack();
    return false;
  }
}


// STAFF - CHANGELOG

// get changelog entries w filters
function getChangelogEntries($filters = [])
{
  global $pdo;

  $sql = 'SELECT c.changelog_id, c.date_created, c.date_last_modified, c.product_id, p.product_name, c.user_id, u.user_email 
          FROM changelog c
          JOIN product p ON c.product_id = p.product_id
          JOIN personal_info u ON c.user_id = u.user_id';

  $whereClauses = [];
  $params = [];

  if (!empty($filters['product_id'])) {
    $whereClauses[] = 'c.product_id = :product_id';
    $params['product_id'] = $filters['product_id'];
  }

  if (!empty($filters['start_date'])) {
    $whereClauses[] = 'c.date_last_modified >= :start_date';
    $params['start_date'] = date('Y-m-d 00:00:00', strtotime($filters['start_date']));
  }

  if (!empty($filters['end_date'])) {
    $whereClauses[] = 'c.date_last_modified <= :end_date';
    $params['end_date'] = date('Y-m-d 23:59:59', strtotime($filters['end_date']));
  }

  if (!empty($filters['user_id'])) {
    $whereClauses[] = 'c.user_id = :user_id';
    $params['user_id'] = $filters['user_id'];
  }

  if ($whereClauses) {
    $sql .= ' WHERE ' . implode(' AND ', $whereClauses);
  }

  $sql .= ' ORDER BY c.date_created DESC';

  $stmt = $pdo->prepare($sql);
  foreach ($params as $key => $value) {
    $stmt->bindValue(':' . $key, $value);
  }

  $stmt->execute();
  return $stmt->fetchAll();
}


// STAFF - PRODUCT MANAGEMENT 

// staff - update product
function updateProduct($product_id, $product_name, $product_model, $manufacturer, $price, $stock_on_hand, $weight, $dimensions, $os, $screensize, $resolution, $cpu, $ram, $storage, $battery, $rear_camera, $front_camera, $description, $image_url)
{
  global $pdo;
  try {
    $pdo->beginTransaction();

    // update - feature table
    $sql = 'UPDATE feature SET weight = :weight, dimensions = :dimensions, OS = :os, screensize = :screensize, resolution = :resolution, CPU = :cpu, RAM = :ram, storage = :storage, battery = :battery, rear_camera = :rear_camera, front_camera = :front_camera, description = :description 
                WHERE feature_id = (SELECT feature_id FROM product WHERE product_id = :product_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':weight' => $weight,
      ':dimensions' => $dimensions,
      ':os' => $os,
      ':screensize' => $screensize,
      ':resolution' => $resolution,
      ':cpu' => $cpu,
      ':ram' => $ram,
      ':storage' => $storage,
      ':battery' => $battery,
      ':rear_camera' => $rear_camera,
      ':front_camera' => $front_camera,
      ':description' => $description,
      ':product_id' => $product_id
    ]);

    // update - product table
    $sql = 'UPDATE product SET product_name = :product_name, product_model = :product_model, manufacturer = :manufacturer, price = :price, stock_on_hand = :stock_on_hand WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      ':product_name' => $product_name,
      ':product_model' => $product_model,
      ':manufacturer' => $manufacturer,
      ':price' => $price,
      ':stock_on_hand' => $stock_on_hand,
      ':product_id' => $product_id
    ]);

    // update - images table
    $sql2 = 'UPDATE images SET image_url = :image_url WHERE product_id = :product_id';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([
      ':image_url' => $image_url,
      ':product_id' => $product_id
    ]);

    // get most recent date_created for the product
    $sql = 'SELECT date_created FROM changelog WHERE product_id = :product_id ORDER BY date_created DESC LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':product_id' => $product_id]);
    $last_date_created = $stmt->fetchColumn();

    // new changelog entry 
    $sql3 = 'INSERT INTO changelog (date_created, date_last_modified, user_id, product_id) VALUES (NOW(), :last_date_created, :user_id, :product_id)';
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([
      ':last_date_created' => $last_date_created,
      ':user_id' => $_SESSION['user_id'],
      ':product_id' => $product_id
    ]);

    $pdo->commit();
    return true;
  } catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Error updating product: " . $e->getMessage());
    return false;
  }
}


// staff - upload image
function uploadProductImage($product_id, $image_file)
{
  global $pdo;

  // image check
  $imageFileType = strtolower(pathinfo($image_file["name"], PATHINFO_EXTENSION));
  $valid_extensions = array("jpg", "jpeg", "png");

  // file type validation
  if (!in_array($imageFileType, $valid_extensions)) {
    return false;
  }

  // current image url
  $sql = 'SELECT image_url FROM images WHERE product_id = :product_id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['product_id' => $product_id]);
  $current_image = $stmt->fetchColumn();

  // upload image
  $target_dir = "../uploads/";
  $target_file = $target_dir . basename($image_file["name"]);
  if (move_uploaded_file($image_file["tmp_name"], $target_file)) {
    $new_image_url = "uploads/" . basename($image_file["name"]);

    // update new image url
    $sql = 'UPDATE images SET image_url = :image_url WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'image_url' => $new_image_url,
      'product_id' => $product_id
    ]);

    // delete old image securely
    if ($current_image) {
      $current_image_path = realpath("../" . $current_image);
      $uploads_dir = realpath("../uploads/");

      if ($current_image_path && strpos($current_image_path, $uploads_dir) === 0) {
        unlink($current_image_path);
      }
    }

    return $new_image_url;
  } else {
    return false;
  }
}


// staff - delete product 
function deleteProduct($product_id)
{
  global $pdo;

  try {
    $pdo->beginTransaction();

    // image URL
    $sql = 'SELECT image_url FROM images WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    $image_url = $stmt->fetchColumn();

    // delete changelog entries of product
    $sql = 'DELETE FROM changelog WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);

    // feature_id
    $sql = 'SELECT feature_id FROM product WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);
    $feature_id = $stmt->fetchColumn();

    // image
    if ($image_url) {
      $image_path = realpath("../" . $image_url);
      $uploads_dir = realpath("../uploads/");

      if ($image_path && strpos($image_path, $uploads_dir) === 0 && file_exists($image_path)) {
        unlink($image_path);
      }
    }

    // delete image from the database
    $sql = 'DELETE FROM images WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);

    // delete product
    $sql = 'DELETE FROM product WHERE product_id = :product_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['product_id' => $product_id]);

    // delete feature
    if ($feature_id) {
      $sql = 'DELETE FROM feature WHERE feature_id = :feature_id';
      $stmt = $pdo->prepare($sql);
      $stmt->execute(['feature_id' => $feature_id]);
    }

    $pdo->commit();
    return true;
  } catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Error deleting product: " . $e->getMessage());
    return false;
  }
}


// staff - product creation
function createProduct($product_name, $product_model, $manufacturer, $price, $stock_on_hand, $weight, $dimensions, $os, $screensize, $resolution, $cpu, $ram, $storage, $battery, $rear_camera, $front_camera, $description, $image_url)
{
  global $pdo;

  try {
    $pdo->beginTransaction();

    // insert-feature table
    $sql = 'INSERT INTO feature (weight, dimensions, OS, screensize, resolution, CPU, RAM, storage, battery, rear_camera, front_camera, description) 
                VALUES (:weight, :dimensions, :os, :screensize, :resolution, :cpu, :ram, :storage, :battery, :rear_camera, :front_camera, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'weight' => $weight,
      'dimensions' => $dimensions,
      'os' => $os,
      'screensize' => $screensize,
      'resolution' => $resolution,
      'cpu' => $cpu,
      'ram' => $ram,
      'storage' => $storage,
      'battery' => $battery,
      'rear_camera' => $rear_camera,
      'front_camera' => $front_camera,
      'description' => $description
    ]);

    $feature_id = $pdo->lastInsertId();

    // insert-product table
    $sql = 'INSERT INTO product (product_name, product_model, manufacturer, price, stock_on_hand, feature_id) 
                VALUES (:product_name, :product_model, :manufacturer, :price, :stock_on_hand, :feature_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'product_name' => $product_name,
      'product_model' => $product_model,
      'manufacturer' => $manufacturer,
      'price' => $price,
      'stock_on_hand' => $stock_on_hand,
      'feature_id' => $feature_id
    ]);

    $product_id = $pdo->lastInsertId();

    // insert-images table
    $sql = 'INSERT INTO images (product_id, image_url) VALUES (:product_id, :image_url)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'product_id' => $product_id,
      'image_url' => $image_url
    ]);

    // insert-changelog table
    $sql = 'INSERT INTO changelog (product_id, date_created, date_last_modified, user_id) 
                VALUES (:product_id, NOW(), NOW(), :user_id)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      'product_id' => $product_id,
      'user_id' => $_SESSION['user_id']
    ]);

    $pdo->commit();
    return $product_id;
  } catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Error creating product: " . $e->getMessage());
    return false;
  }
}
