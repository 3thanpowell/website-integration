<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <title>The Mobile Hour</title>


  <!-- custom css -->
  <style>

    @media (max-width: 470px) {
    .carousel-item img {
    height: 300px;
    width:100vw;
    object-fit: contain;
  
    }
    }
  </style>

</head>



<body>

  <header>
    <!-- home nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">

      <!-- logo -->
      <a class="navbar-brand" href="index.php">
        <img src="images/logo.png" width="220" height="50" alt="The Mobile Hour Logo">
      </a>

      <!-- hamburger toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target= "#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- navbar links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="view/products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="view/brands.php">Brands</a>
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
            <a class="nav-link" href="view/login.php">

            <!-- myacc svg - person (fill) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg> 
          
            My Account 
            </a>
          </li>

        <ul>

      <div>
        
    </nav>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>

      
      <div class="carousel-inner">

        <!-- kode brand slide -->
        <div class="carousel-item active">
          <img class="d-block w-100" src="images/kode_slide.png" alt="Kode brand">
        </div>

        <!-- cellfish 2 item slide -->
        <div class="carousel-item">
          <a href="product.php?id=INSERT_ID HERE">
            <img class="d-block w-100" src="images/cellfish_slide.png" alt="Cellfish 2 product"> 
          </a>
        </div>

        <div class="carousel-item">
          <img class="d-block w-100" src="images/kode_slide.png" alt="">
        </div>
      </div>
      <a class="carousel-control-prev" data-target="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>


  <main>

    <!-- badges -->
    <section class="badges">

      <div class="container p-3">
        <div class="row row-cols-2 row-cols-md-4 m-3">

          <!--shipping -->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
              </svg> 

              <p class="ml-2 text-secondary">SAME HOUR SHIPPING</p>

            </div>
          </div>

          <!--warranty -->
          <div class="col">
            <div class="d-flex">

            <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20a16.405 16.405 0 0 1-5.092-5.804A16.694 16.694 0 0 1 5 6.666L12 4l7 2.667a16.695 16.695 0 0 1-1.908 7.529A16.406 16.406 0 0 1 12 20Z"/>
            </svg>

            <p class="ml-2 text-secondary">9 YEAR WARRANTY</p>

            </div>
          </div>

          <!--free-->
          <div class="col">
            <div class="d-flex">
              
              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
              </svg>

              <p class="ml-2 text-secondary">FREE YOGHURT OVER $200*</p>

            </div>
          </div>

          <!--insurance-->
          <div class="col">
            <div class="d-flex">

              <svg class="pb-3 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="none" viewBox="0 0 24 24" style="min-width:42px !important; min-height:42px !important;">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
              </svg>

              <p class="ml-2 text-secondary">NO SHIPPING INSURANCE</p>

            </div>
          </div>
        </div>
      </div>

    </section>

    <!-- title - mobile phones -->
    <div class="container  p-3 ">
      <div class="row  d-flex">
        <div class="col-auto">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
          <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
          </svg>
        </div>

        <div class="col-8">
          <h1 class="display-5">Mobile Phones</h1>
        </div>

      </div>



    </div>

    <!-- brand showcase -->
    <div class="container p-3">
      <div class="row"> 
        <div class="col-lg-8 col-md-12 col-sm-12">
          
          <img class="img"src="images/display_brand_shishu.png" alt="" width="100%" height="100%">
         
        </div>

        <div class="col-lg-4 col-md-12 col-sm-12 pt-md-3 pt-lg-0 pt-sm-3">
          <div class="row">
            <div class="col-lg-12 col-sm-6 col-md-6 mb-lg-5 mb-md-3">

              <img class="img-fluid"src="images/display_brand_kode.png" alt="" width="100%" height="100%">

            </div>


            <div class="col-lg-12 col-sm-6 col-md-6">
              <img class="img-fluid" src="images/display_brand_panda.png" alt="" width="100%" height="100%">
            </div> 

          </div>
        </div>
      </div>
    </div>

    <!-- product line 1 -->
    <div class="container">
      <div class="row justify-content-center">

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2 ">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- product line 2 -->
    <div class="container">
      <div class="row justify-content-center pt-3">

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- product -->
        <div class="col-lg-3 col-md-5 col-sm-5 col-5 pt-2">
          <div class="card bg-light">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
            
              <div class="row d-flex">
                <div class="col-12">
                  <p class="pt-2"><strong>$199.99</strong></p>
                </div>
                
                <div class="col-12">
                  <a href="#" class="btn btn-info">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>




    






    
  
  </main>
  

  <!-- bootstrap js -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>