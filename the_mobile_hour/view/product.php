<?php
require_once '../model/functions.php';

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    $product = getProductById($product_id);
    if ($product === false) {
        // Handle the case where the product does not exist
        echo "Product not found.";
        exit;
    }
} else {
    // Handle the case where the ID is invalid
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>


<body>

    <!-- Navbar -->
    <?php include 'navbar.php' ?>


    <main>
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
                    <h2>$<?php echo htmlspecialchars($product['price']); ?></h2>
                    <a href="#" class="btn btn-info btn-lg">Order Now</a>
                    <h3 class="mt-4">Key Features</h3>
                    <p>Model: <?php echo htmlspecialchars($product['product_model']); ?></p>
                    <p>Manufacturer: <?php echo htmlspecialchars($product['manufacturer']); ?></p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h3>Specifications</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Key Specifications</h4>
                            <ul>
                                <li>Battery Capacity: <?php echo htmlspecialchars($product['battery']); ?></li>
                                <li>Operating System: <?php echo htmlspecialchars($product['OS']); ?></li>
                                <li>Dimensions: <?php echo htmlspecialchars($product['dimensions']); ?></li>
                                <li>Weight: <?php echo htmlspecialchars($product['weight']); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Display</h4>
                            <ul>
                                <li>Display: <?php echo htmlspecialchars($product['screensize']); ?></li>
                                <li>Screen Resolution: <?php echo htmlspecialchars($product['resolution']); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Camera</h4>
                            <ul>
                                <li>Front Camera: <?php echo htmlspecialchars($product['front_camera']); ?></li>
                                <li>Rear Camera: <?php echo htmlspecialchars($product['rear_camera']); ?></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h4>Storage and Power</h4>
                            <ul>
                                <li>CPU: <?php echo htmlspecialchars($product['CPU']); ?></li>
                                <li>RAM: <?php echo htmlspecialchars($product['RAM']); ?></li>
                                <li>Storage: <?php echo htmlspecialchars($product['storage']); ?></li>
                            </ul>
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
