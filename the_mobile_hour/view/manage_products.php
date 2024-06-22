<?php
session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// filters and search
$filters = [];
$search = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['search'])) {
  $search = $_GET['search'];
}

// products
$products = getProducts($filters, '', $search);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Products</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4">Manage Products</h1>
    </div>


  </header>

  <main class="container mt-5">

    <!--output display  -->
    <?php if (isset($_GET['status'])) : ?>
      <?php if ($_GET['status'] == 'deleted') : ?>
        <div class="alert alert-success">Product deleted successfully!</div>
      <?php elseif ($_GET['status'] == 'error') : ?>
        <div class="alert alert-danger">Failed to delete product. Please try again.</div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- search -->
    <form method="GET" action="manage_products.php" class="mb-4">
      <div class="form-group">
        <input type="text" id="search" name="search" class="form-control" placeholder="Search Product Name or Brand" value="<?php echo htmlspecialchars($search); ?>">
      </div>
      <button type="submit" class="btn btn-primary">Search</button>
      <a href="manage_products.php" class="btn btn-secondary">Reset</a>
    </form>

    <!-- products table -->
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Manufacturer</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($products as $product) : ?>
            <tr>
              <th scope="row"><?php echo htmlspecialchars($product['product_id']); ?></th>
              <td><a href="product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>"><?php echo htmlspecialchars($product['product_name']); ?></a></td>
              <td><?php echo htmlspecialchars($product['manufacturer']); ?></td>
              <td><a href="edit_product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-warning">Edit</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
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