<?php

session_start();

// kicks user if not logged in or not a customer
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'customer') {
    header('Location: login.php');
    exit();
}

$firstname = $_SESSION['firstname'];
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
        
            <h3>Customer Dashboard</h3>
            <p>Customer-specific content goes here.</p>

        <a href="../controller/logout.php" class="btn btn-primary">Logout</a>
    </div>



    <!-- footer -->
    <?php include 'footer.php'; ?>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
