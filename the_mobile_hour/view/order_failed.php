<?php
session_start();

// kicks user if not logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Failed</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
      <h1 class="display-4">Order Failed</h1>
    </div>
  </header>



  <main class="container">

    <div class="row">

      <div class="col-12">
        <p>There was a problem with your order, please try again or contact support.</p>

        <ul class="list-unstyled">
          <li><strong>Email: </strong> themobilehour@email.com</li>
          <li><strong>Phone: </strong> +61 412 345 678</li>
        </ul>


      </div>

      <div class="col-12">
        <a href="products.php">
          <p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-left" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223" />
            </svg>

            Continue Shopping
          </p>
        </a>
      </div>

    </div>
  </main>


  <!-- footer - stick to bottom -->
  <div class="fixed-bottom">
    <?php include 'footer.php'; ?>
  </div>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html