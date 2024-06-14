<?php
session_start();

// Kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// Initialize filters, sort, and search variables
$filters = [];
$sort = '';
$search = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['role']) && $_SESSION['user_role'] == 'manager') {
    $filters['role'] = $_GET['role'];
  }
  if (!empty($_GET['search'])) {
    $search = $_GET['search'];
  }
  if (!empty($_GET['sort'])) {
    $sort = $_GET['sort'];
  }
}

// Fetch users based on role
if ($_SESSION['user_role'] == 'manager') {
  $users = getAllUsers($filters, $sort, $search);
} elseif ($_SESSION['user_role'] == 'admin') {
  $users = getCustomers($filters, $sort, $search);
} else {
  $users = [];
}
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

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4 mb-4">Manage Users</h1>

      <!-- delete user message -->
      <?php if (isset($_GET['status'])) : ?>
        <?php if ($_GET['status'] == 'deleted') : ?>
          <div class="alert alert-success">User deleted successfully!</div>
        <?php elseif ($_GET['status'] == 'error') : ?>
          <div class="alert alert-danger">Failed to delete user. Please try again.</div>
        <?php endif; ?>
      <?php endif; ?>

    </div>

  </header>

  <div class="container">
    <!-- filter and search Form -->
    <form method="GET" action="manage_users.php" class="mb-4">
      <div class="form-row">
        
        <!-- select role only for managers -->
        <?php if ($_SESSION['user_role'] == 'manager') : ?>
          <div class="form-group col-md-4">
            <select id="role" name="role" class="form-control">
              <option value="">Filter By Role</option>
              <option value="admin" <?php echo (!empty($filters['role']) && $filters['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
              <option value="manager" <?php echo (!empty($filters['role']) && $filters['role'] == 'manager') ? 'selected' : ''; ?>>Manager</option>
              <option value="customer" <?php echo (!empty($filters['role']) && $filters['role'] == 'customer') ? 'selected' : ''; ?>>Customer</option>
            </select>
          </div>
        <?php endif; ?>

        <div class="form-group col-md-4">
          <input type="text" id="search" name="search" placeholder="Search..." class="form-control" value="<?php echo htmlspecialchars($search); ?>">
        </div>

        <div class="form-group col-md-4">
          <select id="sort" name="sort" class="form-control">
            <option value="">Sort By</option>
            <option value="name_asc" <?php echo ($sort == 'name_asc') ? 'selected' : ''; ?>>Name Ascending</option>
            <option value="name_desc" <?php echo ($sort == 'name_desc') ? 'selected' : ''; ?>>Name Descending</option>
          </select>
        </div>

      </div>

      <button type="submit" class="btn btn-primary">Filter</button>

      <button type="button" class="btn btn-secondary" onclick="window.location.href='manage_users.php';">Reset</button>

    </form>
  </div>

  <div class="container mt-5 table-responsive">

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

            <th scope="row"><?php echo htmlspecialchars($user['user_id']); ?></th>

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