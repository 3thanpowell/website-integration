<?php
session_start();

// Kicks user if not logged in or not an admin/manager
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'manager')) {
  header('Location: login.php');
  exit();
}

require_once '../model/functions.php';

// Initialize filters
$filters = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['product_id'])) {
    $filters['product_id'] = intval($_GET['product_id']);
  }
  if (!empty($_GET['start_date'])) {
    $filters['start_date'] = $_GET['start_date'];
  }
  if (!empty($_GET['end_date'])) {
    $filters['end_date'] = $_GET['end_date'];
  }
  if (!empty($_GET['user_id'])) {
    $filters['user_id'] = intval($_GET['user_id']);
  }
}

// Fetch changelog entries
$changelogEntries = getChangelogEntries($filters);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Changelog</title>

  <!-- bootstrap cdn link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <header>
    <!-- navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
      <h1 class="display-4 mb-4">Changelog</h1>

      <!-- Search form -->
      <form method="GET" action="changelog.php" class="mb-4">
        <div class="form-row">
          <div class="form-group col-md-2">
            <input type="number" id="product_id" name="product_id" class="form-control" placeholder="Product ID" value="<?php echo isset($filters['product_id']) ? htmlspecialchars($filters['product_id']) : ''; ?>">
          </div>

          <div class="form-group col-md-2">
            <input type="number" id="user_id" name="user_id" class="form-control" placeholder="User ID" value="<?php echo isset($filters['user_id']) ? htmlspecialchars($filters['user_id']) : ''; ?>">
          </div>

          <div class="col-md-2">
            <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#dateRange" aria-expanded="false" aria-controls="dateRange">
              Filter Date
            </button>
          </div>

          <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="changelog.php" class="btn btn-secondary">Reset</a>
          </div>
        </div>


        <!-- collapse for date range -->
        <div class="collapse" id="dateRange">
          <div class="card card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Start Date" value="<?php echo isset($filters['start_date']) ? htmlspecialchars($filters['start_date']) : ''; ?>">
              </div>

              <div class="form-group col-md-6">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" placeholder="End Date" value="<?php echo isset($filters['end_date']) ? htmlspecialchars($filters['end_date']) : ''; ?>">
              </div>

              <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="changelog.php" class="btn btn-secondary">Reset</a>
              </div>
            </div>


          </div>
        </div>
      </form>

      <!-- Changelog table -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">Changelog ID</th>
              <th scope="col">Date Created</th>
              <th scope="col">Date Last Modified</th>
              <th scope="col">Product ID</th>
              <th scope="col">Product Name</th>
              <th scope="col">User ID</th>
              <th scope="col">First Name</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($changelogEntries as $entry) : ?>
              <tr>
                <th scope="row"><?php echo htmlspecialchars($entry['changelog_id']); ?></th>
                <td><?php echo htmlspecialchars($entry['date_created']); ?></td>
                <td><?php echo htmlspecialchars($entry['date_last_modified']); ?></td>
                <td><?php echo htmlspecialchars($entry['product_id']); ?></td>
                <td><?php echo htmlspecialchars($entry['product_name']); ?></td>
                <td><?php echo htmlspecialchars($entry['user_id']); ?></td>
                <td><?php echo htmlspecialchars($entry['firstname']); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </header>

  <!-- footer -->
  <?php include 'footer.php'; ?>

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>