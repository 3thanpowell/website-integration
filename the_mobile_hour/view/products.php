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
$productChunks = array_chunk($products, 4); // Split products into chunks for display

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

    <!-- page title -->

    <div class="container  p-3 ">
      <div class="row">

        <div class="col-8">
          <h1 class="display-5">Mobile Phones</h1>
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
    <!-- Filter and search form -->
    <div class="container mb-4">
      <form method="GET" action="products.php">
        <div class="row">
          <div class="col-md-3">
            <select name="brand" class="form-control">
              <option value="">All Brands</option>
              <?php foreach ($brands as $brand): ?>
                <option value="<?php echo htmlspecialchars($brand); ?>"><?php echo htmlspecialchars($brand); ?></option>
              <?php endforeach; ?>
              <!-- Add other brands here -->
            </select>
          </div>
          <div class="col-md-3">
            <select name="sort" class="form-control">
              <option value="">Sort By</option>
              <option value="name_asc">Name A-Z</option>
              <option value="name_desc">Name Z-A</option>
              <option value="price_asc">Price Low to High</option>
              <option value="price_desc">Price High to Low</option>
            </select>
          </div>
          <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search Products">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
          </div>
        </div>
      </form>
    </div>
    
    <!-- product line -->
    <div class="container">
      <?php foreach ($productChunks as $productRow): ?>
        <div class="row justify-content-center pt-3">
          <?php foreach ($productRow as $product): ?>
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
                      <a href="#" class="btn btn-info">Order Now</a>
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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>