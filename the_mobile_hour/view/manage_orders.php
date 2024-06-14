<?php
session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// initialize filters and search variables
$filters = [];
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['status'])) {
    $filters['status'] = $_GET['status'];
  }
  if (!empty($_GET['search'])) {
    $search = $_GET['search'];
  }
}

// fetch orders based on filters and search
$orders = getUserOrders($filters, $search);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $orderNumber = $_POST['order_number'];
  $status = $_POST['order_status'];
  if (updateOrderStatus($orderNumber, $status)) {
    header('Location: manage_orders.php?o_status=updated');
    exit();
  } else {
    header('Location: manage_orders.php?o_status=error');
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Orders</title>

  <!-- bootstrap cdn link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4 mb-4">Manage Orders</h1>

      <!-- update status message -->
      <?php if (isset($_GET['o_status'])) : ?>
        <?php if ($_GET['o_status'] == 'updated') : ?>
          <div class="alert alert-success">Order status updated successfully!</div>
        <?php elseif ($_GET['o_status'] == 'error') : ?>
          <div class="alert alert-danger">Failed to update order status. Please try again.</div>
        <?php endif; ?>
      <?php endif; ?>

      <!-- filter and search form -->
      <form method="GET" action="manage_orders.php" class="mb-4">
        <div class="form-row">
          <div class="form-group col-md-4">
            <select id="status" name="status" class="form-control" placeholder="filter by status">
              <option value="">Order Status</option>
              <option value="Processing" <?php echo (!empty($filters['status']) && $filters['status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
              <option value="Packed" <?php echo (!empty($filters['status']) && $filters['status'] == 'Packed') ? 'selected' : ''; ?>>Packed</option>
              <option value="Shipped" <?php echo (!empty($filters['status']) && $filters['status'] == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
              <option value="Delivered" <?php echo (!empty($filters['status']) && $filters['status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
              <option value="Cancelled" <?php echo (!empty($filters['status']) && $filters['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <input type="text" id="search" name="search" class="form-control" placeholder="Search by customer ID or Email" value="<?php echo htmlspecialchars($search); ?>">
          </div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="manage_orders.php" class="btn btn-secondary">Reset</a>
          </div>
        </div>
      </form>
    </div>
  </header>

  <div class="container mt-5 table-responsive">

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Order Number</th>
          <th scope="col">Order Date</th>
          <th scope="col">Customer ID</th>
          <th scope="col">User Email</th>
          <th scope="col">Status</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($orders as $order) : ?>

          <tr>
            <th scope="row"><?php echo htmlspecialchars($order['order_number']); ?></th>
            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
            <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
            <td><?php echo htmlspecialchars($order['user_email']); ?></td>

            <!-- bg color for status -->
            <td class="<?php echo match ($order['order_status']) {
                          'Processing' => 'alert-dark',
                          'Packed' => 'alert-primary',
                          'Shipped' => 'alert-info',
                          'Delivered' => 'alert-success',
                          'Cancelled' => 'alert-danger',
                          default => '' 
                        }; ?>">

              <!-- option color for status -->
              <form method="POST" action="manage_orders.php">
                <input type="hidden" name="order_number" value="<?php echo htmlspecialchars($order['order_number']); ?>">
                <select name="order_status" class="form-control" <?php echo ($order['order_status'] == 'Cancelled') ? 'disabled' : ''; ?>>
                  <option value="Processing" <?php echo ($order['order_status'] == 'Processing') ? 'selected' : ''; ?> class="text-dark">Processing</option>
                  <option value="Packed" <?php echo ($order['order_status'] == 'Packed') ? 'selected' : ''; ?> class="text-primary">Packed</option>
                  <option value="Shipped" <?php echo ($order['order_status'] == 'Shipped') ? 'selected' : ''; ?> class="text-info">Shipped</option>
                  <option value="Delivered" <?php echo ($order['order_status'] == 'Delivered') ? 'selected' : ''; ?> class="text-success">Delivered</option>
                  <option value="Cancelled" <?php echo ($order['order_status'] == 'Cancelled') ? 'selected' : ''; ?> class="text-danger">Cancelled</option>
                </select>
            </td>
            <td>
              <?php if ($order['order_status'] != 'Cancelled') : ?>
                <button type="submit" class="btn btn-warning">Update</button>
              <?php endif; ?>
              </form>
            </td>
          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqDQ+KvnfHR3Ew5ne4hi8tW8SY0hlWl7S2p7jhbZoVNAs4QEl6" crossorigin="anonymous"></script>

</body>

</html>