<?php
session_start();

// kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id == 0) {
  header('Location: manage_users.php');
  exit();
}

$user = getUserById($user_id);
if (!$user) {
  header('Location: manage_users.php');
  exit();
}

$success = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = trim($_POST['email']);
  $firstname = trim($_POST['firstname']);
  $lastname = trim($_POST['lastname']);
  $phone = trim($_POST['phone']);
  $address = trim($_POST['address']);
  $postcode = trim($_POST['postcode']);
  $city = trim($_POST['city']);
  $state = trim($_POST['state']);

  $result = updateUser($user_id, $email, $firstname, $lastname, $phone, $address, $postcode, $city, $state);

  if ($result === true) {
    $success = true;
  } elseif ($result === 'duplicate') {
    $errorMessage = "The email address is already registered.";
  } else {
    $errorMessage = "Failed to update user.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Edit User</title>


  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>

  <!-- navbar -->
  <?php include 'navbar.php'; ?>

  <div class="container">
    <h1 class="display-4 m-4">Edit User Information</h1>
  </div>


  <div class="container mt-5 p-5 border border-secondary rounded">

    <!-- output message here -->
    <?php if (isset($_GET['status'])) : ?>
      <?php if ($_GET['status'] == 'promoted') : ?>
        <div class="alert alert-success">User promoted to admin successfully!</div>
      <?php elseif ($_GET['status'] == 'demoted') : ?>
        <div class="alert alert-success">User demoted to customer successfully!</div>
      <?php elseif ($_GET['status'] == 'error') : ?>
        <div class="alert alert-danger">Failed to promote or demote user. Please try again.</div>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ($success) : ?>
      <div class="alert alert-success">User updated successfully!</div>
    <?php endif; ?>
    <?php if ($errorMessage) : ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <form method="POST" id='editUserForm'>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
      </div>

      <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
      </div>

      <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($user['user_phone']); ?>" required>
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['user_address']); ?>" required>
      </div>

      <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo htmlspecialchars($user['postcode']); ?>" required>
      </div>

      <div class="form-group">
        <label for="city">City</label>
        <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($user['city']); ?>" required>
      </div>

      <div class="form-group">
        <label for="state">State</label>
        <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($user['state']); ?>" required>
      </div>

      <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#confirmUpdateModal">Update User</button>
      <button type="reset" class="btn btn-secondary">Cancel Changes</button>


    </form>

    <!-- critical actions (delete, promote) -->
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
            <!-- delete user -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal">Delete User</button>

            <!-- make admin (only managers) -->
            <?php if ($_SESSION['user_role'] == 'manager' && $user['user_role'] == 'customer') : ?>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmPromoteModal">Promote to Admin</button>
              <!-- make customer (only managers) -->
            <?php elseif ($_SESSION['user_role'] == 'manager' && $user['user_role'] == 'admin') : ?>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#confirmDemoteModal">Demote to Customer</button>
            <?php endif; ?>

            <!-- send password reset link - does nothing at all -->
            <button class="btn btn-warning">Email Password Reset Link</button>

          </div>
        </div>
      </div>
    </div>





  </div>

  <!-- confirmation Modal for Update -->
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
          Are you sure you want to update this user?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" onclick="document.getElementById('editUserForm').submit();">Yes, Update</button>
        </div>
      </div>
    </div>
  </div>

  <!-- confirmation Modal for Delete -->
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
          Are you sure you want to delete this user?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="../controller/delete_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-danger">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <!-- confirmation Modal for Promote -->
  <div class="modal fade" id="confirmPromoteModal" tabindex="-1" role="dialog" aria-labelledby="confirmPromoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmPromoteModalLabel">Confirm Promotion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to promote this user to admin?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="../controller/promote_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-info">Promote</a>
        </div>
      </div>
    </div>
  </div>

  <!-- confirmation Modal for Demote -->
  <div class="modal fade" id="confirmDemoteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDemoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDemoteModalLabel">Confirm Demotion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to demote this user to customer?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <a href="../controller/demote_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-warning">Demote</a>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>