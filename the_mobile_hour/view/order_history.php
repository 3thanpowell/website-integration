<?php
session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

$customerId = $_SESSION['customer_id'];
$orders = getAllOrders($customerId);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Management</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>


<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4">Order History</h1>
    </div>

  </header>

  <main>

    <div class="container mt-5">

      <?php if (count($orders) > 0) : ?>
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">Order Number</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Order Date</th>
                <th scope="col">Status</th>
                <th scope="col">Delivery Date</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($orders as $order) : ?>
                <tr>
                  <th scope="row"><?php echo htmlspecialchars($order['order_number']); ?></td>
                  <td><img src="../<?php echo htmlspecialchars($order['image_url']); ?>" alt="Product Image" width="50"></td>
                  <td>
                    <a href="product.php?id=<?php echo htmlspecialchars($order['product_id']); ?>">

                      <?php echo htmlspecialchars($order['product_name']); ?>

                    </a>

                  </td>
                  <td><?php echo htmlspecialchars($order['order_date']); ?></th>

                  <td>

                    <!-- colour coded status -->
                    <?php
                    $status = htmlspecialchars($order['order_status']);
                    $statusColor = '';

                    switch ($status) {
                      case 'Processing':
                        $statusColor = 'text-dark';
                        break;
                      case 'Packed':
                        $statusColor = 'text-warning';
                        break;
                      case 'Shipped':
                        $statusColor = 'text-info';
                        break;
                      case 'Delivered':
                        $statusColor = 'text-success';
                        break;
                      case 'Cancelled':
                        $statusColor = 'text-danger';
                        break;
                      default:
                        $statusColor = 'text-secondary';
                        break;
                    }
                    ?>

                    <span class="<?php echo $statusColor; ?>">
                      <?php echo $status; ?>
                    </span>

                  </td>

                  <!-- order_delivery_date set only once order_status is set to delivered -->
                  <td><?php echo htmlspecialchars($order['order_delivery_date'] ?: 'Not yet delivered'); ?></td>

                  <!-- cancel order button - only if ordeer_status is still set as "Processing" -->
                  <td>
                    <?php if ($order['order_status'] == 'Processing') : ?>
                      <form method="POST" action="../controller/cancel_order.php" style="display:inline;">
                        <input type="hidden" name="order_number" value="<?php echo htmlspecialchars($order['order_number']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Cancel Order</button>
                      </form>
                    <?php else : ?>
                      N/A
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else : ?>
        <p>No orders yet.</p>
      <?php endif; ?>
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