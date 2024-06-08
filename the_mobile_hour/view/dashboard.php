<?php
// view/dashboard.php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_role = $_SESSION['role'];
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?></h2>

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
