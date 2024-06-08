<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$userRole = $isLoggedIn ? $_SESSION['user_role'] : '';

?>
<!-- navbar  -->

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

  <!-- logo -->
  <a class="navbar-brand" href="../index.php">
    <img src="../images/logo.png" width="220" height="50" alt="The Mobile Hour Logo">
  </a>
  
  <!-- hamburger toggler -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target= "#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- navbar links -->
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="brands.php">Brands</a>
      </li>
    </ul>

    <!-- navbar left margin items -->
    <ul class="navbar-nav ml-auto">

        <!-- search bar -->
      <form class="d-flex" role="search">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" style= "font-size: 15px">
        <button class="btn btn-outline-white" type="submit">
          <!-- search svg - magn glass-->
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search mb-2" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
        </button>
      </form>
     

      <!-- myacc -->
      <li class="nav-item ml-2">

        <!-- checks if user is logged in -->
        <?php if ($isLoggedIn): ?>

          <!-- if logged in, check which type -->
          <?php if ($userRole === 'admin'): ?>

            <a class="nav-link" href="admin_dashboard.php">

              <!-- myacc svg - person (fill) -->
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg> 
       
              <?php echo htmlspecialchars($_SESSION['firstname']); ?>
            </a>

          <?php elseif ($userRole === 'manager'): ?>

            <a class="nav-link" href="manager_dashboard.php">

              <!-- myacc svg - person (fill) -->
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg> 
       
              <?php echo htmlspecialchars($_SESSION['firstname']); ?>
            </a> 
          
          <?php else: ?>
            
            <a class="nav-link" href="dashboard.php">

              <!-- myacc svg - person (fill) -->
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg> 
       
              <?php echo htmlspecialchars($_SESSION['firstname']); ?>  
            </a>
          
          <?php endif; ?>

        <?php else: ?>
            <a class="nav-link" href="login.php">

              <!-- myacc svg - person (fill) -->
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
              </svg> 
       
              My Account 
            </a>
        <?php endif; ?>

      </li>

    <ul>

  <div>
    
</nav>