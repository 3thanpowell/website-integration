<!DOCTYPE html>
<html lang="en">
<head>

  

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <title>The Mobile Hour</title>

</head>

<body>
  <!-- navbar -->
  <?php include 'view/navbar.php'; ?>

  <header>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
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

        <div class="carousel-item placeholder">
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
    <div class="container d-flex p-3">

      <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
       <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
      </svg>

      <h1 class="display-4"> Mobile Phones </h1>

    </div>

    <!-- brand showcase -->
    <div class="container">
      <div class="row"> 
        <div class="col-lg-8 col-sm-12">
          
          <img class="img"src="images/display_brand_shishu.png" alt="" width="100%" height="97.8%">
         
        </div>

        <div class="col-lg-4 col-sm-12">
          <div class="row">
            <div class="col-lg-12 col-sm-6">

              <img class="img-fluid"src="images/display_brand_shishu.png" alt="" width="100%" height="100%">

            </div>

            <div class="col-lg-12 col-sm-6 m-2"></div>


            <div class="col-lg-12 col-sm-6">
              <img class="img-fluid" src="images/display_brand_shishu.png" alt="" width="100%" height="100%">
            </div> 

          </div>
        </div>
      </div>
    </div>

    <!-- Products -->
    <div class="container">
      <div class="row">

        <!-- Product -->
        <div class="col-lg-3 col-m-6 col-sm-12">
          <div class="card">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="row d-flex">
                <div class="col-6 align">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col">
                  <a href="#" class="btn btn-success">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- Product -->
        <div class="col-lg-3 col-m-6 col-sm-12">
          <div class="card">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="row d-flex">
                <div class="col-6 align">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col">
                  <a href="#" class="btn btn-success">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- Product -->
        <div class="col-lg-3 col-m-6 col-sm-12">
          <div class="card">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="row d-flex">
                <div class="col-6 align">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col">
                  <a href="#" class="btn btn-success">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- Product -->
        <div class="col-lg-3 col-m-6 col-sm-12">
          <div class="card">
            <img class="card-img-top" src="images/placeholder.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Product Name</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <div class="row d-flex">
                <div class="col-6 align">
                  <p class="pt-2"><strong>$19.99</strong></p>
                </div>
                
                <div class="col">
                  <a href="#" class="btn btn-success">Order Now</a>
                </div>
              </div>
              
            </div>
          </div>
        </div>

    </div>






    
  
  </main>
  

  <!-- Bootstrap JS CDN link -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>