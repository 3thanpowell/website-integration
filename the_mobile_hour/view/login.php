<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Mobile Hour</title>

  <!-- bootstrap CSS CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4">Login</h1>
    </div>
  </header>

  <main>

    <!-- login -->
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12 border rounded bg-light p-5">

          <h3 class="">Registered Customers</h3>
          <p class="">Sign in using your email</p>

          <form class="m-4" action="../controller/login_process.php" method="post">
            <div class="form-group">
              <label for="email" class="font-weight-bold">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="password" class="font-weight-bold">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>

            <?php if (isset($_GET['error'])) : ?>
              <div class="alert alert-danger">
                Invalid email or password.
              </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-lg btn-dark">Sign in</button>
          </form>

        </div>




        <!-- sign up -->
        <div class="col-lg-6 col-sm-12 col-md-12 border rounded bg-light p-5">

          <h3 class="">New Customers</h3>
          <p class="">Place orders and keep track of them too, by creating an account!</p>


          <a href="signup.php" class="text-white text-decoration-none btn btn-info btn-lg m-3">Register</a>

        </div>
      </div>
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