<?php
session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// search variable
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
  $search = trim($_GET['search']);
}

// stock update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_id = intval($_POST['product_id']);
  $amount = intval($_POST['amount']);
  $action = $_POST['action'];

  error_log("Updating stock: Product ID = $product_id, Amount = $amount, Action = $action");

  if (updateStock($product_id, $amount, $action)) {
    $status = 'updated';
  } else {
    $status = 'error';
  }
}

// products for inventory management
$products = getProductsForInventory($search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Inventory</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4 mt-5">Manage Inventory</h1>
    </div>

  </header>

  <main>

    <div class="container mt-5">


      <!-- output status message -->
      <?php if (isset($status)) : ?>
        <?php if ($status == 'updated') : ?>
          <div class="alert alert-success">Stock updated successfully!</div>
        <?php elseif ($status == 'error') : ?>
          <div class="alert alert-danger">Failed to update stock. Please try again.</div>
        <?php endif; ?>
      <?php endif; ?>

      <!-- search form -->
      <form method="GET" action="manage_inventory.php" class="mb-4">
        <div class="form-row">
          <div class="form-group col-md-8">
            <input type="text" id="search" name="search" class="form-control" placeholder="Search Product ID, Name, or Manufacturer" value="<?php echo htmlspecialchars($search); ?>">
          </div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="manage_inventory.php" class="btn btn-secondary">Reset</a>
          </div>
        </div>
      </form>

      <!-- inventory management table -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">Product ID</th>
              <th scope="col">Product Name</th>
              <th scope="col">Manufacturer</th>
              <th scope="col">Stock on Hand</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($products as $product) : ?>

              <tr>
                <th scope="row"><?php echo htmlspecialchars($product['product_id']); ?></th>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['manufacturer']); ?></td>
                <td><?php echo htmlspecialchars($product['stock_on_hand']); ?></td>
                <td>
                  <form method="POST" action="manage_inventory.php" class="form-inline">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                    <input type="number" name="amount" class="form-control mb-2 mr-sm-2" required>
                    <button type="submit" name="action" value="add" class="btn btn-success mb-2">Add</button>
                    <button type="submit" name="action" value="subtract" class="btn btn-danger mb-2">Subtract</button>
                  </form>
                </td>
              </tr>

            <?php endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqDQ+KvnfHR3Ew5ne4hi8tW8SY0hlWl7S2p7jhbZoVNAs4QEl6" crossorigin="anonymous"></script>

</body>

</html>