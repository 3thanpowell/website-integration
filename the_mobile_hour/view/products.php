<?php

require_once '../model/functions.php';

$filters = [];
$sort = '';
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['brand'])) {
    $filters['brand'] = $_GET['brand'];
  }
  if (!empty($_GET['sort'])) {
    $sort = $_GET['sort'];
  }
  if (!empty($_GET['search'])) {
    $search = $_GET['search'];
  }
}

$brands = getAllBrands();

$products = getProducts($filters, $sort, $search);
$productChunks = array_chunk($products, 4);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <div class="row">

        <div class="col-8">
          <h1 class="display-4">Mobile Phones</h1>
        </div>

        <div class="col-9 mt-4">
          <p>
            Here at The Mobile Hour every minute counts in finding the perfect phone for you.
            Explore our collection of cutting-edge mobile devices designed to keep you connected and empowered.
          </p>
          <hr>
        </div>
      </div>
    </div>
  </header>

  <main>
    <!-- filter and search form -->
    <div class="container mb-4">

      <form method="GET" action="products.php">
        <div class="row ml-lg-5">
          <div class="col-md-3 mt-2">
            <select name="brand" class="form-control">
              <option value="">All Brands</option>
              <?php foreach ($brands as $brand) : ?>
                <option value="<?php echo htmlspecialchars($brand); ?>" <?php echo (isset($_GET['brand']) && $_GET['brand'] === $brand) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($brand); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-3 mt-2">
            <select name="sort" class="form-control">
              <option value="">Sort By</option>
              <option value="name_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'name_asc') ? 'selected' : ''; ?>>Name A-Z</option>
              <option value="name_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'name_desc') ? 'selected' : ''; ?>>Name Z-A</option>
              <option value="price_asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'price_asc') ? 'selected' : ''; ?>>Price Low to High</option>
              <option value="price_desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'price_desc') ? 'selected' : ''; ?>>Price High to Low</option>
            </select>
          </div>

          <div class="col-md-3 mt-2">
            <input type="text" name="search" class="form-control" placeholder="Search Products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          </div>

          <div class="col-md-3 col-sm-6 mt-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='products.php';">Reset</button>
          </div>

        </div>
      </form>
    </div>


    <!-- product line -->
    <div class="container">
      <?php foreach ($productChunks as $productRow) : ?>
        <div class="row justify-content-center pt-3">
          <?php foreach ($productRow as $product) : ?>
            <!-- product -->
            <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
              <div class="card bg-light">
                <img class="card-img-top" src="../<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product image">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                  <div class="row d-flex">
                    <div class="col-12">
                      <p class="pt-2"><strong>$<?php echo htmlspecialchars($product['price']); ?></strong></p>
                    </div>
                    <div class="col-12">
                      <a href="product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-info">
                        Order Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
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