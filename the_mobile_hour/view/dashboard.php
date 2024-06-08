<?php

session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$firstname = $_SESSION['firstname'];
$user_role = $_SESSION['user_role']; //this is not needed, delete along with the calls to $user_role later
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- bootstrap CDN link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

    <!-- navbar -->
    <?php include 'navbar.php'; ?>


    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($firstname); ?></h2>

        <?php if ($user_role == 'admin'): ?>
            <h3>Admin Dashboard</h3>
            <p>Admin-specific content goes here.</p>
            <!-- Admin functionalities -->

        <?php elseif ($user_role == 'manager'): ?>
            <h3>Manager Dashboard</h3>
            <p>Manager-specific content goes here.</p>
            <!-- Manager functionalities -->

        <?php else: ?>
            <h3>Customer Dashboard</h3>
            <p>Customer-specific content goes here.</p>
            <!-- Customer functionalities -->

        <?php endif; ?>

        <a href="../controller/logout.php" class="btn btn-primary">Logout</a>
    </div>
    <script src="path/to/bootstrap.js"></script>

    <!-- footer -->
    <?php include 'footer.php'; ?>
</body>
</html>
