<?php
require_once '../model/functions.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
  $product = getProductById($product_id);
  if ($product === false) {
    // no product
    echo "Product not found.";
    exit;
  }
} else {
  // bouncer
  echo "Invalid product ID.";
  exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($product['product_name']); ?> - The Mobile Hour</title>

  <!-- bootstrap CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<body>

  <!-- Navbar -->
  <?php include 'navbar.php' ?>


  <main>
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6 ">
          <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid border">
        </div>
        <div class="col-md-6">

          <h1 class="display-4">
            <?php echo htmlspecialchars($product['product_name']); ?>
          </h1>

          <h2 class="mt-lg-3">
            $<?php echo htmlspecialchars($product['price']); ?>
          </h2>

          <form method="POST" action="../controller/order_process.php">
            <input type="hidden" name="order_product_id" value="<?php echo $product_id; ?>">

            <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">

            <button type="submit" class="btn btn-danger btn-lg mt-5">Place Order</button>
          </form>

          <h3 class="mt-4">Key Features</h3>
          <p>
            <strong>Model: </strong>
            <?php echo htmlspecialchars($product['product_model']); ?>
          </p>

          <p>
            <strong>Manufacturer: </strong>
            <?php echo htmlspecialchars($product['manufacturer']); ?>
          </p>

          <p class="lead">

            <?php echo htmlspecialchars($product['description']); ?>

          </p>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-md-12 mt-5">

          <h1 class="mb-5">
            Specifications
          </h1>

          <div class="row mt-3">
            <div class="col-md-6 border border-dark bg-light rounded p-3">

              <h4>Key Specifications</h4>

              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Battery Capacity</th>
                    <td><?php echo htmlspecialchars($product['battery']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Operating System</th>
                    <td><?php echo htmlspecialchars($product['OS']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Dimensions</th>
                    <td><?php echo htmlspecialchars($product['dimensions']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Weight</th>
                    <td><?php echo htmlspecialchars($product['weight']); ?></td>
                  </tr>
                </tbody>
              </table>

            </div>


            <div class="col-md-6 border border-dark bg-light rounded p-3">

              <h4>Display</h4>

              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Display</th>
                    <td><?php echo htmlspecialchars($product['screensize']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Screen Resolution</th>
                    <td><?php echo htmlspecialchars($product['resolution']); ?></td>
                  </tr>
                </tbody>
              </table>

            </div>


            <div class="col-md-6 border border-dark bg-light rounded p-3">

              <h4>Camera</h4>

              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Front Camera</th>
                    <td><?php echo htmlspecialchars($product['front_camera']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Rear Camera</th>
                    <td><?php echo htmlspecialchars($product['rear_camera']); ?></td>
                  </tr>
                </tbody>
              </table>

            </div>


            <div class="col-md-6 border border-dark bg-light rounded p-3">

              <h4>Storage and Power</h4>

              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">CPU</th>
                    <td><?php echo htmlspecialchars($product['CPU']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">RAM</th>
                    <td><?php echo htmlspecialchars($product['RAM']); ?></td>
                  </tr>
                  <tr>
                    <th scope="row">Storage</th>
                    <td><?php echo htmlspecialchars($product['storage']); ?></td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php include 'footer.php' ?>







  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>