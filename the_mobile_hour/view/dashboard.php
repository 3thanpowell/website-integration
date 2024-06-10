<?php

session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

$firstname = $_SESSION['firstname'];
$customerId = $_SESSION['customer_id'];

//gets logged in customer's recent orders 
$recentOrders = getRecentOrders($customerId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

  <!-- navbar -->
  <?php include 'navbar.php'; ?>



  <body>

    <main>

      <div class="container-fluid p-5">
        <div class="row">

          <!-- sidebar -->
          <div class="col-md-3 col-lg-2 sidebar border-right">
            <h3 class="my-4">Welcome,
              <?php echo ucfirst(htmlspecialchars($firstname)); ?>
            </h3>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active h6" href="edit_info.php">
                  Update Account Information
                </a>
                <hr>
              </li>
              <li class="nav-item">
                <a class="nav-link h6" href="order_history.php">
                  Manage Orders
                </a>
                <hr>
              </li>

              <li class="nav-item">
                <a class="nav-link btn-secondary text-center btn-lg" href="../controller/logout.php">
                  <span class="h4">Logout</span>
                </a>
              </li>

            </ul>
          </div>

          <!-- main content -->
          <div class="col-md-9 col-lg-10">
            <h1 class="my-4">Recent Orders</h1>

            <?php if (count($recentOrders) > 0) : ?>
              <ul class="list-group">
                <?php foreach ($recentOrders as $order) : ?>
                  <li class="list-group-item">
                    <div class="media">

                      <!-- product image -->
                      <img src="../<?php echo htmlspecialchars($order['image_url']); ?>" class="mr-3 img-fluid" style="max-width: 100px;" alt="Product image">

                      <div class="media-body">

                        <h4 class="mb-3 h4">
                          <?php echo htmlspecialchars($order['product_name']); ?>
                        </h4>

                        <p><strong>Order Number:</strong>
                          <?php echo htmlspecialchars($order['order_number']); ?>
                        </p>

                        <p><strong>Order Date:</strong>
                          <?php echo htmlspecialchars($order['order_date']); ?>
                        </p>

                        <p><strong>Status:</strong>
                          <?php echo htmlspecialchars($order['order_status']); ?>
                        </p>

                        <p><strong>Delivery Date:</strong>
                          <?php echo htmlspecialchars($order['order_delivery_date'] ? $order['order_delivery_date'] : 'Not yet delivered'); ?>
                        </p>

                      </div>
                    </div>
                  </li>

                <?php endforeach; ?>
              </ul>
            <?php else : ?>
              <p class="h4">No orders yet..</p>
            <?php endif; ?>
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