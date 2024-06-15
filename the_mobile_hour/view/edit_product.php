<?php
session_start();

// Kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// Get product ID from the query string
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch product details
$product = getProductById($product_id);
if (!$product) {
  echo "Product not found.";
  exit();
}

// Handle form submission
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

  // Handle image upload
  if (!empty($_FILES['image']['name'])) {
    $image_url = uploadProductImage($product_id, $_FILES['image']);
  } else {
    $image_url = $product['image_url'];
  }

  // Update product details
  $result = updateProduct($product_id, $product_name, $product_model, $manufacturer, $price, $stock_on_hand, $weight, $dimensions, $os, $screensize, $resolution, $cpu, $ram, $storage, $battery, $rear_camera, $front_camera, $description, $image_url);

  if ($result) {
    header('Location: edit_product.php?id=' . $product_id . '&status=updated');
    exit();
  } else {
    $error_message = "Failed to update product. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>

  <!-- bootstrap cdn link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <!-- Navbar -->
  <?php include 'navbar.php' ?>

  <main>
    <div class="container mt-4">
      <h1 class="display-4 mb-4">Edit Product Details</h1>
      <div class="row">
        <div class="col-md-6">
          <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid border">
          <form method="POST" action="edit_product.php?id=<?php echo $product_id; ?>" enctype="multipart/form-data" id="editProductForm">
            <div class="form-group mt-3 border rounded p-3">
              <label for="image">Update Product Image</label>
              <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>
        <div class="col-md-6">

          <h1 class=""><?php echo htmlspecialchars($product['product_name']); ?></h1>

          <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
          <?php endif; ?>

          <?php if (isset($_GET['status']) && $_GET['status'] == 'updated') : ?>
            <div class="alert alert-success">Product updated successfully!</div>
          <?php endif; ?>

          <?php if (isset($_GET['status']) && $_GET['status'] == 'new') : ?>
            <div class="alert alert-success">New Product Created Succesfully!</div>
          <?php endif; ?>

          <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['status'] == 'delete_error') : ?>
              <div class="alert alert-danger">Failed to delete product. Please try again.</div>
            <?php elseif ($_GET['status'] == 'invalid_id') : ?>
              <div class="alert alert-danger">Invalid product ID.</div>
            <?php endif; ?>
          <?php endif; ?>

          <table class="table border rounded mt-4">
            <tbody>
              <tr>
                <th scope="row"><label for="product_name">Product Name</label></th>
                <td><input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required></td>
              </tr>

              <tr>
                <th scope="row"><label for="price">Price</label></th>
                <td><input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required></td>
              </tr>

            </tbody>
          </table>

          <h3 class="mt-5">Key Features</h3>

          <table class="table border rounded mt-4">
            <tbody>
              <tr>
                <th scope="row"><label for="product_model">Product Model</label></th>
                <td><input type="text" class="form-control" id="product_model" name="product_model" value="<?php echo htmlspecialchars($product['product_model']); ?>" required></td>
              </tr>
              <tr>
                <th scope="row"><label for="manufacturer">Manufacturer</label></th>
                <td><input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?php echo htmlspecialchars($product['manufacturer']); ?>" required></td>
              </tr>

              <tr>
                <th scope="row"><label for="description">Description</label></th>
                <td><textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea></td>
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
                  <td><input type="text" class="form-control" id="battery" name="battery" value="<?php echo htmlspecialchars($product['battery']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="os">Operating System</label></th>
                  <td><input type="text" class="form-control" id="os" name="os" value="<?php echo htmlspecialchars($product['OS']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="dimensions">Dimensions</label></th>
                  <td><input type="text" class="form-control" id="dimensions" name="dimensions" value="<?php echo htmlspecialchars($product['dimensions']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="weight">Weight</label></th>
                  <td><input type="text" class="form-control" id="weight" name="weight" value="<?php echo htmlspecialchars($product['weight']); ?>" required></td>
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
                  <td><input type="text" class="form-control" id="screensize" name="screensize" value="<?php echo htmlspecialchars($product['screensize']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="resolution">Resolution</label></th>
                  <td><input type="text" class="form-control" id="resolution" name="resolution" value="<?php echo htmlspecialchars($product['resolution']); ?>" required></td>
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
                  <td><input type="text" class="form-control" id="front_camera" name="front_camera" value="<?php echo htmlspecialchars($product['front_camera']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="rear_camera">Rear Camera</label></th>
                  <td><input type="text" class="form-control" id="rear_camera" name="rear_camera" value="<?php echo htmlspecialchars($product['rear_camera']); ?>" required></td>
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
                  <td><input type="text" class="form-control" id="cpu" name="cpu" value="<?php echo htmlspecialchars($product['CPU']); ?>" required></td>
                </tr>
                <tr>
                  <th scope="row"><label for="ram">RAM</label></th>
                  <td><input type="text" class="form-control" id="ram" name="ram" value="<?php echo htmlspecialchars($product['RAM']); ?>" required></td>
                </tr>
                <tr>
                  <th scope="row"><label for="storage">Storage</label></th>
                  <td><input type="text" class="form-control" id="storage" name="storage" value="<?php echo htmlspecialchars($product['storage']); ?>" required></td>
                </tr>

                <tr>
                  <th scope="row"><label for="stock_on_hand">Stock On Hand</label></th>
                  <td><input type="number" class="form-control" id="stock_on_hand" name="stock_on_hand" value="<?php echo htmlspecialchars($product['stock_on_hand']); ?>" required></td>
                </tr>

              </tbody>
            </table>

          </div>

          <div class="col-md-12 text-center p-5">
            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#confirmUpdateModal">Update Product</button>
            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>

            <div class="accordion mt-3" id="dangerOptions">
              <div class="card">
                <div class="card-header alert-danger" id="headingOne">
                  <h1>
                    <button class="btn btn-block btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <strong>Critical Actions</strong>
                    </button>
                  </h1>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#dangerOptions">
                  <div class="card-body">
                    <!-- delete product -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Delete Product</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          </form>

        </div>
      </div>

      <!-- confirm update modal -->
      <div class="modal fade" id="confirmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmUpdateModalLabel">Confirm Update</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to update this Product?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" onclick="document.getElementById('editProductForm').submit();">Yes, Update</button>
            </div>
          </div>
        </div>
      </div>

      <!-- confirm delete modal -->
      <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <a href="../controller/delete_product.php?id=<?php echo $product_id; ?>" class="btn btn-danger">Yes, Delete</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>

  <!-- footer -->
  <?php include 'footer.php' ?>

  <!-- bootstrap js -->
  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>