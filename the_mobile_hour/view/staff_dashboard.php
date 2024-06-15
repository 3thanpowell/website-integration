<?php

session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

$firstname = $_SESSION['firstname'];
$user_role = $_SESSION['user_role'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>


  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="../css/stylesheet.css">




</head>

<body>


  <header>

    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container">
      <h1 class="p-5">
        Welcome, <?php echo ucfirst(htmlspecialchars($firstname)); ?>
      </h1>
    </div>

  </header>




  <main>

    <div class="container">
      <div class="row">

        <div class="col-md-4 col-sm-6">
          <a href="manage_orders.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>Orders</h5>
              </div>
              <div class="card-body">
                <p>View and manage orders</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-sm-6">
          <a href="manage_users.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>User Accounts</h5>
              </div>
              <div class="card-body">
                <p>View and manage account information</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-sm-6">
          <a href="manage_inventory.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>Inventory</h5>
              </div>
              <div class="card-body">
                <p>View and edit current stock on hand</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-sm-6">
          <a href="changelog.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>Changelog</h5>
              </div>
              <div class="card-body">
                <p>Review and track all modifications made to product listings</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-sm-6">
          <a href="manage_products.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>Products</h5>
              </div>
              <div class="card-body">
                <p>View and modify product details</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-4 col-sm-6">
          <a href="create_product.php" class="text-decoration-none bubble">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">
                <h5>New Product</h5>
              </div>
              <div class="card-body">
                <p>Create a new product</p>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>













  </main>






  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>