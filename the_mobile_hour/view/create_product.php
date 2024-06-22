<?php
session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $product_name = $_POST['product_name'];
  $product_model = $_POST['product_model'];
  $manufacturer = $_POST['manufacturer'];
  $price = $_POST['price'];
  $stock_on_hand = $_POST['stock_on_hand'];
  $weight = $_POST['weight'];
  $dimensions = $_POST['dimensions'];
  $os = $_POST['os'];
  $screensize = $_POST['screensize'];
  $resolution = $_POST['resolution'];
  $cpu = $_POST['cpu'];
  $ram = $_POST['ram'];
  $storage = $_POST['storage'];
  $battery = $_POST['battery'];
  $rear_camera = $_POST['rear_camera'];
  $front_camera = $_POST['front_camera'];
  $description = $_POST['description'];

  // image upload
  if (!empty($_FILES['image']['name'])) {
    $image_url = uploadProductImage($product_id, $_FILES['image']);
  } else {
    $image_url = '../uploads/default.jpg';
  }

  // create product
  $product_id = createProduct($product_name, $product_model, $manufacturer, $price, $stock_on_hand, $weight, $dimensions, $os, $screensize, $resolution, $cpu, $ram, $storage, $battery, $rear_camera, $front_camera, $description, $image_url);

  if ($product_id) {
    header('Location: edit_product.php?id=' . $product_id . '&status=new');
    exit();
  } else {
    $error_message = "Failed to create product. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php' ?>

    <div class="container mt-5">
      <h1 class="display-4">New Product</h1>
    </div>

  </header>

  <main>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mt-2">
          <form method="POST" action="create_product.php" enctype="multipart/form-data" id="createProductForm">
            <div class="form-group mt-3 border rounded p-3">
              <label for="image">Product Image</label>
              <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
        </div>
        <div class="col-md-6">

          <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
          <?php endif; ?>

          <table class="table border rounded mt-4">
            <tbody>
              <tr>
                <th scope="row"><label for="product_name">Product Name</label></th>
                <td><input type="text" class="form-control" id="product_name" name="product_name" required></td>
              </tr>

              <tr>
                <th scope="row"><label for="price">Price</label></th>
                <td><input type="number" step="0.01" class="form-control" id="price" name="price" required></td>
              </tr>

            </tbody>
          </table>

          <h3 class="mt-5">Key Features</h3>

          <table class="table border rounded mt-4">
            <tbody>
              <tr>
                <th scope="row"><label for="product_model">Product Model</label></th>
                <td><input type="text" class="form-control" id="product_model" name="product_model" required></td>
              </tr>
              <tr>
                <th scope="row"><label for="manufacturer">Manufacturer</label></th>
                <td><input type="text" class="form-control" id="manufacturer" name="manufacturer" required></td>
              </tr>

              <tr>
                <th scope="row"><label for="description">Description</label></th>
                <td><textarea class="form-control" id="description" name="description" required></textarea></td>
              </tr>
            </tbody>
          </table>

          <div class="col-md-12">

          </div>

        </div>

      </div>

      <div class="container mt-4">
        <div class="row">
          <div class="col-md-12">
            <h1 class="mb-5">
              Specifications
            </h1>
          </div>

          <div class="col-md-6 border border-dark bg-light rounded p-3">

            <h4>Key Specifications</h4>

            <table class="table">
              <tbody>

                <tr>
                  <th scope="row"><label for="battery">Battery Capacity</label></th>
                  <td><input type="text" class="form-control" id="battery" name="battery" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="os">Operating System</label></th>
                  <td><input type="text" class="form-control" id="os" name="os" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="dimensions">Dimensions</label></th>
                  <td><input type="text" class="form-control" id="dimensions" name="dimensions" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="weight">Weight</label></th>
                  <td><input type="text" class="form-control" id="weight" name="weight" required></td>
                </tr>

              </tbody>

            </table>
          </div>

          <div class="col-md-6 border border-dark bg-light rounded p-3">

            <h4>Display</h4>

            <table class="table">
              <tbody>
                <tr>
                  <th scope="row"><label for="screensize">Screen Size</label></th>
                  <td><input type="text" class="form-control" id="screensize" name="screensize" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="resolution">Resolution</label></th>
                  <td><input type="text" class="form-control" id="resolution" name="resolution" required></td>
                </tr>

              </tbody>
            </table>

          </div>

          <div class="col-md-6 border border-dark bg-light rounded p-3">
            <h4>Camera</h4>

            <table class="table">
              <tbody>
                <tr>
                  <th scope="row"><label for="front_camera">Front Camera</label></th>
                  <td><input type="text" class="form-control" id="front_camera" name="front_camera" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="rear_camera">Rear Camera</label></th>
                  <td><input type="text" class="form-control" id="rear_camera" name="rear_camera" required></td>
                </tr>

              </tbody>
            </table>
          </div>

          <div class="col-md-6 border border-dark bg-light rounded p-3">

            <h4>Storage and Power</h4>

            <table class="table">
              <tbody>

                <tr>
                  <th scope="row"><label for="cpu">CPU</label></th>
                  <td><input type="text" class="form-control" id="cpu" name="cpu" required></td>
                </tr>
                <tr>
                  <th scope="row"><label for="ram">RAM</label></th>
                  <td><input type="text" class="form-control" id="ram" name="ram" required></td>
                </tr>
                <tr>
                  <th scope="row"><label for="storage">Storage</label></th>
                  <td><input type="text" class="form-control" id="storage" name="storage" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="stock_on_hand">Stock On Hand</label></th>
                  <td><input type="number" class="form-control" id="stock_on_hand" name="stock_on_hand" required></td>
                </tr>

              </tbody>
            </table>

          </div>

          <div class="col-md-12 text-center p-5">
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#confirmCreateModal">Create Product</button>
            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
          </div>

          </form>

        </div>
      </div>

      <!-- confirm modal -->
      <div class="modal fade" id="confirmCreateModal" tabindex="-1" role="dialog" aria-labelledby="confirmCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmCreateModalLabel">Confirm Create</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to create this Product?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" onclick="document.getElementById('createProductForm').submit();">Yes, Create</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- footer -->
  <?php include 'footer.php' ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>