<?php
session_start();

// Kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// Fetch users based on role
$users = ($_SESSION['user_role'] == 'manager') ? getAllUsers() : getCustomers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Manage Users</title>

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



</head>

<body>

  <!-- navbar -->
  <?php include 'navbar.php'; ?>

  <div class="container mt-5 table-responsive">
    <h1 class="display-4 mb-4">Manage Users</h1>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">User ID</th>
          <th scope="col">Role</th>
          <th scope="col">Email</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($users as $user) : ?>

          <tr>

            <th scope="row"><?php echo htmlspecialchars($user['user_id']); ?></td>

            <td><?php echo htmlspecialchars($user['user_role']); ?></td>

            <td><?php echo htmlspecialchars($user['user_email']); ?></td>

            <td><?php echo ucfirst(htmlspecialchars($user['firstname'])); ?></td>

            <td><?php echo htmlspecialchars($user['lastname']); ?></td>

            <td class="text-center">

              <a href="edit_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-warning ">Edit</a>

            </td>

          </tr>

        <?php endforeach; ?>

      </tbody>
    </table>
  </div>

  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIqDQ+KvnfHR3Ew5ne4hi8tW8SY0hlWl7S2p7jhbZoVNAs4QEl6" crossorigin="anonymous"></script>
</body>

</html>