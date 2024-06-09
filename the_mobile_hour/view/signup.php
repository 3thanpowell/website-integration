<?php
require_once '../model/functions.php';

// error message to be displayed on error
$errorMessage = '';

// empty variables to be left filled in on error 
$firstname = '';
$lastname = '';
$email = '';
$phone = '';
$address = '';
$postcode = '';
$city = '';
$state = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $postcode = trim($_POST['postcode']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);

    $result = registerUser($email, $password, $firstname, $lastname, $phone, $address, $postcode, $city, $state);

    if ($result === true) {
        echo "Registration successful!";
        // redirect to login page
        header('Location: login.php');
        exit;
    } elseif ($result === 'duplicate') {
        $errorMessage = "The email address is already registered.";
    } else {
        $errorMessage = "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <header>
    <?php include 'navbar.php'; ?>
    <div class="container pt-3">
      <h1 class="display-5 p-5">Create an Account</h1>
    </div>
  </header>
  <main>
  <div class="container">
    <div class="row">
      <div class="col-12 border rounded bg-light p-5 mb-2">
        <p class="">Already have an account? <span><a href="login.php">Log in.</a></span></p>

        <?php if ($errorMessage): ?>
          <div class="alert alert-danger" role="alert">
        <?php echo $errorMessage; ?>
          </div>
        <?php endif; ?>
        
        <form class="m-4 font-weight-bold" method="POST" action="signup.php" oninput='confirmPassword.setCustomValidity(confirmPassword.value != password.value ? "Passwords do not match." : "")'>
        
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
            </div>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
          </div>

          <div class="form-group position-relative">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" 
            aria-describedby="passwordHelpBlock" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$" required>
            <small id="passwordHelpBlock" class="form-text text-muted">
              Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </small>
              <span class="position-absolute" id="togglePassword" style="cursor: pointer; right: 10px; top: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
              </span>
          </div>

          <div class="form-group position-relative">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
              <span class="position-absolute" id="toggleConfirmPassword" style="cursor: pointer; right: 10px; top: 40px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                </svg>
              </span>
          </div>
          
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" name="phone" id="phone" pattern='^(?:\+?61|0)[2-478](?:[ \-]?[0-9]){8}$' title="Please enter a valid Australian phone number" value="<?php echo htmlspecialchars($phone); ?>" required>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="e.g 12 Address Rd" value="<?php echo htmlspecialchars($address); ?>" required>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="city">City</label>
              <input type="text" name="city" class="form-control" id="city" value="<?php echo htmlspecialchars($city); ?>" required>
            </div>

            <div class="form-group col-md-6">
              <label for="state">State</label>
              <select id="state" name="state" class="form-control" required>
                <option value="">Choose...</option>
                <option value="New South Wales" <?php echo $state == 'New South Wales' ? 'selected' : ''; ?>>New South Wales</option>
                <option value="Victoria" <?php echo $state == 'Victoria' ? 'selected' : ''; ?>>Victoria</option>
                <option value="Queensland" <?php echo $state == 'Queensland' ? 'selected' : ''; ?>>Queensland</option>
                <option value="South Australia" <?php echo $state == 'South Australia' ? 'selected' : ''; ?>>South Australia</option>
                <option value="Western Australia" <?php echo $state == 'Western Australia' ? 'selected' : ''; ?>>Western Australia</option>
                <option value="Tasmania" <?php echo $state == 'Tasmania' ? 'selected' : ''; ?>>Tasmania</option>
                <option value="Australian Capital Territory" <?php echo $state == 'Australian Capital Territory' ? 'selected' : ''; ?>>Australian Capital Territory</option>
                <option value="Northern Territory" <?php echo $state == 'Northern Territory' ? 'selected' : ''; ?>>Northern Territory</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="postcode">Postcode</label>
              <input type="text" class="form-control" id="postcode" name="postcode" pattern="[0-9]{4}" title="Please enter a valid 4-digit postcode" value="<?php echo htmlspecialchars($postcode); ?>" required>
            </div>
          </div>

          <button type="submit" class="btn btn-dark btn-lg">Register</button>

        </form>
      </div>
    </div>
  </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="../js/signupValidation.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
  
  <!-- show password toggle -->
  <script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
    
      const passwordField = document.getElementById('password');
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function (e) {
    
      const confirmPasswordField = document.getElementById('confirmPassword');
      const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPasswordField.setAttribute('type', type);
    });
  </script>
</body>
</html>
