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

  <!-- navbar -->
  <?php include 'navbar.php'; ?>


  <main>

    <div class="container mt-5">
      <h1 class="display-4 mb-4">Order History</h1>
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

                  <td><?php echo htmlspecialchars($order['order_delivery_date'] ?: 'Not yet delivered'); ?></td>
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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>