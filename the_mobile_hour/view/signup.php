<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>
  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <!-- page title -->
    <div class="container pt-3">
      <h1 class="display-5 p-5">
        Create an Account
      </h1>
    </div>
  </header>

  <!-- registration form -->
  <main>
  <div class="container">
    <div class="row">
      <div class="col-12 border rounded bg-light p-5">
        
        <p class="">Already have an account? <span><a href="login.php">Log in.</a></span></p>
        
        <form class="m-4 font-weight-bold" oninput='confirmPassword.setCustomValidity(confirmPassword.value != userPassword.value ? "Passwords do not match." : "")'>
        
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstName">First Name</label>
              <input type="text" class="form-control" id="firstName" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lastName">Last Name</label>
              <input type="text" class="form-control" id="lastName" required>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" required>
          </div>

          <div class="form-group">
            <label for="userPassword">Password</label>
            <input type="password" id="userPassword" class="form-control" aria-describedby="passwordHelpBlock" required>
            <small id="passwordHelpBlock" class="form-text text-muted">
              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </small>
          </div>

          <div class="form-group">
            <label for="confirmPassword"> Confirm Password</label>
            <input type="password" id="confirmPassword" class="form-control" required>
          </div>
          
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" id="phone" required>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" placeholder="e.g 12 Address Rd" required>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" required>
            </div>

            <div class="form-group col-md-6">
              <label for="state">State</label>
              <select id="state" class="form-control" required>
                <option selected>Choose...</option>
                <option>New South Wales</option>
                <option>Victoria</option>
                <option>Queensland</option>
                <option>South Australia</option>
                <option>Western Australia</option>
                <option>Tasmania</option>
                <option>Australian Capital Territory</option>
                <option>Northern Territory</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="postcode">Postcode</label>
              <input type="text" class="form-control" id="postcode" pattern="[0-9]{4}" title="Please enter a valid 4-digit postcode" required>
            </div>
          </div>

          <button type="submit" class="btn btn-dark btn-lg">Create an Account</button>

        </form>


      </div>
    </div>
  </div>
  </main>

  


<!-- bootstrap js  -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
</body>
</html>