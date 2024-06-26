<?php
session_start();
require_once 'model/functions.php';

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['user_role'] : '';

//getProducts $limit=8
$products = getProducts([], '', '', 8);

//splits products into 4 chunks for display
$productChunks = array_chunk($products, 4);

?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Mobile Hour</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <!-- custom css - carousel clarity-->
  <link rel="stylesheet" href="css/stylesheet.css">


</head>

<body>

  <header>
    <!-- home nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top border-bottom">

      <!-- logo -->
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="220" height="50" alt="The Mobile Hour Logo">
      </a>

      <!-- hamburger toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- navbar links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="view/products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view/brands.php">Brands</a>
          </li>
        </ul>

        <!-- navbar left margin items -->
        <ul class="navbar-nav ml-auto">

          <!-- myacc -->
          <li class="nav-item ml-2">
            <!-- checks if user is logged in -->
            <?php if ($isLoggedIn) : ?>

              <!-- if logged in, check which type -->
              <?php if ($userRole === 'admin' || $userRole === 'manager') : ?>

                <a class="nav-link" href="view/staff_dashboard.php">

                  <!-- myacc svg - person (fill) -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                  </svg>

                  <?php echo ucfirst(htmlspecialchars($_SESSION['firstname'])); ?>
                </a>

              <?php else : ?>

                <a class="nav-link" href="view/dashboard.php">

                  <!-- myacc svg - person (fill) -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                  </svg>

                  <?php echo ucfirst(htmlspecialchars($_SESSION['firstname'])); ?>
                </a>

              <?php endif; ?>

            <?php else : ?>
              <a class="nav-link" href="view/login.php">

                <!-- myacc svg - person (fill) -->
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                </svg>

                My Account
              </a>
            <?php endif; ?>
          </li>

          <ul>

            <div>

    </nav>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>


      <div class="carousel-inner">

        <!-- product slide -->
        <div class="carousel-item active">
          <a href="view/product.php?id=1">
            <img class="d-block w-100" src="images/carousel_cellfish.jpg" alt="cellfish product image">
          </a>
        </div>

        <!-- brand slide -->
        <div class="carousel-item">
          <a href="view/products.php?brand=PANDA">
            <img class="d-block w-100" src="images/carousel_panda.jpg" alt="panda brand image">
          </a>
        </div>

        <!-- brand slide -->
        <div class="carousel-item">
          <a href="view/products.php?brand=UD">
            <img class="d-block w-100" src="images/carousel_ud.jpg" alt="ud brand image">
          </a>
        </div>
      </div>

      <a class="carousel-control-prev" data-target="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>


  <main>

    <?php require 'model/db.php'; ?>

    <!-- badges -->
    <section class="badges">

      <div class="container p-3">
        <div class="row row-cols-2 row-cols-md-4 m-3">

          <!--shipping -->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>

              <p class="ml-2 text-secondary">SAME HOUR SHIPPING</p>

            </div>
          </div>

          <!--warranty -->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a16.405 16.405 0 0 1-5.092-5.804A16.694 16.694 0 0 1 5 6.666L12 4l7 2.667a16.695 16.695 0 0 1-1.908 7.529A16.406 16.406 0 0 1 12 20Z" />
              </svg>

              <p class="ml-2 text-secondary">9 YEAR WARRANTY</p>

            </div>
          </div>

          <!--free-->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
              </svg>

              <p class="ml-2 text-secondary">FREE YOGHURT OVER $876.72*</p>

            </div>
          </div>

          <!--insurance-->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>

              <p class="ml-2 text-secondary">NO SHIPPING INSURANCE</p>

            </div>
          </div>
        </div>
      </div>

    </section>

    <!-- title - mobile phones -->
    <div class="container  p-3 ">
      <div class="row  d-flex">
        <div class="col-auto">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
          </svg>
        </div>

        <div class="col-8">
          <h1 class="display-5">Mobile Phones</h1>
        </div>

      </div>



    </div>

    <!-- brand showcase -->
    <div class="container p-3">
      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">

          <a href="view/products.php?brand=SHISHU"><img class="img" src="images/display_brand_shishu.png" alt="" width="100%" height="100%"></a>

        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 pt-md-3 pt-lg-0 pt-sm-3">
          <div class="row">
            <div class="col-lg-12 col-sm-6 col-md-6 mb-lg-5 mb-md-3">

              <a href="view/products.php?brand=KODE"><img class="img-fluid" src="images/display_brand_kode.png" alt="" width="100%" height="100%"></a>

            </div>


            <div class="col-lg-12 col-sm-6 col-md-6">
              <a href="view/products.php?brand=PANDA"><img class="img-fluid" src="images/display_brand_panda.png" alt="" width="100%" height="100%"></a>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- product line -->
    <div class="container">
      <?php foreach ($productChunks as $productRow) : ?>
        <div class="row justify-content-center pt-3">
          <?php foreach ($productRow as $product) : ?>
            <!-- product -->
            <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
              <div class="card bg-light">
                <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product image">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                  <div class="row d-flex">
                    <div class="col-12">
                      <p class="pt-2"><strong>$<?php echo htmlspecialchars($product['price']); ?></strong></p>
                    </div>
                    <div class="col-12">
                      <a href="view/product.php?id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-info">Order Now</a>
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

  <footer>
    <div class="container-fluid bg-light border mt-5">
      <div class="row mr-2 ml-2 pt-3">
        <div class="col-lg-4 col-12 col-md-5">

          <!-- contact -->
          <h2>
            Contact Us
          </h2>

          <ul class="list-unstyled" style="font-size: 16px;">
            <li><span class="font-weight-bold">Address:</span> 123 Address Rd, suburb, QLD, 4123</li>
            <li><span class="font-weight-bold">Email:</span> themobilehour@email.com</li>
            <li><span class="font-weight-bold">Phone:</span> +61 412 345 678</li>
          </ul>


          <!-- socials - no links added -->
          <div class="row">
            <div class="col-12">
              <h2>
                Socials
              </h2>
            </div>

            <div class="col-12">

              <!-- twitter -->
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-twitter-x m-3 text-secondary" viewBox="0 0 16 16">
                <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
              </svg>

              <!-- instagram -->
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-instagram m-3 text-secondary" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
              </svg>

              <!-- facebook -->
              <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-facebook m-3 text-secondary" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
              </svg>
            </div>
          </div>



        </div>

        <!-- shop -->
        <div class="col-lg-6 col-12 col-md-4">
          <h2>
            Shop
          </h2>

          <ul class="list-unstyled" style="font-size: 16px;">
            <li> <a href="view/products.php">Products</a></li>
            <li><a href="view/brands.php">Brands</a></li>
          </ul>

        </div>

        <!-- login -->
        <div class="col-lg-2 col-12 col-md-3">
          <?php if ($isLoggedIn) : ?>
            <h2 class="ml-auto mr-3">
              All done?
            </h2>

            <a href="../controller/logout.php" style="font-size: 16px;"> Logout </a>


          <?php else : ?>

            <h2 class="ml-auto mr-3">
              Have An Account?
            </h2>

            <a href="login.php" style="font-size: 16px;">Login</a>

          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- copyright -->
    <div class="container-fluid bg-secondary text-white">
      <div class="row">
        <div class="col-12">
          <p class="text-center pt-3">
            &copy;
          </p>
        </div>
      </div>
    </div>
  </footer>


  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>