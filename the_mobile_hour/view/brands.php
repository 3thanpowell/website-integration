<?php
require_once '../model/functions.php';

// get all brands
$brands = getAllBrands();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brands</title>

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
          <h1 class="display-4">Brands</h1>
        </div>

        <div class="col-9 mt-4">
          <p>
            Explore our curated selection of mobile phone brands. Discover the brands that drive the world of mobile technology forward, ensuring that you stay connected, empowered, and ahead of the curve.
          </p>
          <hr>
        </div>
      </div>
    </div>
  </header>

  <main>
    <div class="container">
      <div class="row">
        <?php if (!empty($brands)) : ?>
          <?php foreach ($brands as $brand) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 pt-2">
              <div class="card bg-light text-center">
                <div class="card-body">
                  <h1 class="card-title display-4"><?php echo htmlspecialchars($brand); ?></h1>
                  <a href="products.php?brand=<?php echo urlencode($brand); ?>" class="btn btn-dark">View Products</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <p>No brands found.</p>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php include 'footer.php'; ?>
</body>

</html>