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

//gets logged in customer 3 recent orders  
$recentOrders = getRecentOrders($customerId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

  <header>

    <!-- navbar -->
    <?php include 'navbar.php'; ?>

  </header>




  <main>

    <div class="container-fluid p-5">
      <div class="row">

        <!-- sidebar -->
        <div class="col-md-3 col-sm-12 col-lg-2 sidebar border-right">
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
        <div class="col-md-9 col-sm-12 col-lg-10">
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>