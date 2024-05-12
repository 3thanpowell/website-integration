<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>The Mobile Hour</title>

  <!-- Bootstrap CSS CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
  <header>
    <!-- nav -->
    <?php include 'navbar.php'; ?>

    <!-- pg title -->
    <div class="container pt-3">
      <h1 class="display-5 p-5">
        Login
      </h1>
    </div>

  </header>

  <main>
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12 border rounded bg-light p-5">

          <h3 class="">Registered Customers</h3>
          <p class="">Sign in using your email</p>  

          <form class="m-4">
            <div class="form-group">
              <label for="exampleInputEmail1" class="font-weight-bold">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="font-weight-bold">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-lg btn-dark">Sign in</button>
          </form>

        </div>

        <div class="col-lg-6 col-sm-12 col-md-12 border rounded bg-light p-5">

          <h3 class="">New Customers</h3>
          <p class="">Save your address and keep track of your orders by creating an account.</p> 

          <button type="button" class="btn btn-info btn-lg m-3">
            <a href="signup.php" class="text-white" style="text-decoration: none; !important">Register</a>
          </button>




          </div>
      </div>
    </div>

  </main>

  

  <!-- Bootstrap JS CDN link -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>