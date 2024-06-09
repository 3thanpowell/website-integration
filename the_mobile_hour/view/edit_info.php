<?php
session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
    header('Location: login.php');
    exit();
}

require_once '../model/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $postcode = trim($_POST['postcode']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);

    $result = updateUserInfo($_SESSION['user_id'], $email, $firstname, $lastname, $phone, $address, $postcode, $city, $state);

    if ($result === 'duplicate') {
        $errorMessage = "The email address is already registered to another account.";
    } elseif ($result === true) {
        // Update session data
        $_SESSION['user_email'] = $email;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['user_phone'] = $phone;
        $_SESSION['user_address'] = $address;
        $_SESSION['postcode'] = $postcode;
        $_SESSION['city'] = $city;
        $_SESSION['state'] = $state;

        $successMessage = "Information updated successfully.";
    } else {
        $errorMessage = "Failed to update information.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Information</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>

  <!-- navbar -->
  <?php include 'navbar.php'; ?>


  <main>
    
    <div class="container">
      <h1 class="display-4 m-4">Edit Information</h1>
    </div>

    <div class="container mt-5 p-5 border border-secondary rounded">
    
      <?php if (isset($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
      <?php elseif (isset($errorMessage)): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
      <?php endif; ?>


      <form method="POST" action="edit_info.php">

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>" required>
          </div>

          <div class="form-group col-md-6">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>" required>
          </div>  
        </div>

        <div class="form-group">
          <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" pattern='^(?:\+?61|0)[2-478](?:[ \-]?[0-9]){8}$' title="Please enter a valid Australian phone number" value="<?php echo htmlspecialchars($_SESSION['user_phone']); ?>" required>
        </div>

        <div class="form-group">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($_SESSION['user_address']); ?>" required>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" id="postcode" name="postcode" pattern="[0-9]{4}" title="Please enter a valid 4-digit postcode" value="<?php echo htmlspecialchars($_SESSION['postcode']); ?>" required>
          </div>

          <div class="form-group col-md-6">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($_SESSION['city']); ?>" required>
          </div>
        </div>

        <div class="form-group">
          <label for="state">State</label>
          <select id="state" name="state" class="form-control" required>
            <option value="New South Wales" <?php echo $_SESSION['state'] == 'New South Wales' ? 'selected' : ''; ?>>New South Wales</option>
            <option value="Victoria" <?php echo $_SESSION['state'] == 'Victoria' ? 'selected' : ''; ?>>Victoria</option>
            <option value="Queensland" <?php echo $_SESSION['state'] == 'Queensland' ? 'selected' : ''; ?>>Queensland</option>
            <option value="South Australia" <?php echo $_SESSION['state'] == 'South Australia' ? 'selected' : ''; ?>>South Australia</option>
            <option value="Western Australia" <?php echo $_SESSION['state'] == 'Western Australia' ? 'selected' : ''; ?>>Western Australia</option>
            <option value="Tasmania" <?php echo $_SESSION['state'] == 'Tasmania' ? 'selected' : ''; ?>>Tasmania</option>
            <option value="Australian Capital Territory" <?php echo $_SESSION['state'] == 'Australian Capital Territory' ? 'selected' : ''; ?>>Australian Capital Territory</option>
            <option value="Northern Territory" <?php echo $_SESSION['state'] == 'Northern Territory' ? 'selected' : ''; ?>>Northern Territory</option>
          </select>
        </div>

        <button type="submit" class="btn btn-dark">Update Info</button>
        <button type="reset" class="btn btn-secondary">Cancel Changes</button>
      </form>

    </div>  

  </main>


  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>
</html>