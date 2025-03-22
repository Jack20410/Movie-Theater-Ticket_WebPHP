<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../resources/head.php'?>
    <link rel="stylesheet" type="text/css" href="/webFinal/resources/css/main.css">
</head>
<body>
        <!-- Header start -->
        <?php include '../resources/header.php'?>
    
        <!-- Menu start -->
        <?php include '../resources/menu.php'?>

        <!-- Main -->
        <div class="container">

        <?php
        include'../resources/film_db.php';
        $id = $_GET['id'];
        $query = mysqli_query($conn,"SELECT * FROM film_available where id = '$id'");
        while ($row = mysqli_fetch_array($query))
        {
          ?>

             <!-- Breadcrumbs -->
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a style="text-decoration: none;" href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'] ?></li>
                  </ol>
              </nav>
              <!-- End Breadcrumbs -->

              <span class="h1 text-white" style="padding: 20px 0;">Movie detail</span>
               <!-- Product detail -->
              <div class="product-info row" style="color: white;">
                  <div class="movie-poster col-6">
                      <img src="../assets/images/Poster/<?php echo $row['image'] ?>">
                      
                      <button class="btn btn-primary text-black buy-ticket" type="submit"><a href="booking.php?id=<?php echo $row['id'] ?>"
                                style="text-decoration: none; color: black">Booking</a></button>
                  </div>
                  <div class="movie-detail col-6">
                      <div class="movie-name movie-info">
                          <span class="h1"> <?php echo $row['name'] ?> </span>
                      </div>

                      <div class="movie-director movie-info">
                          <h4>Director : </h4>
                          <p><?php echo $row['director'] ?></p>
                      </div>

                      <div class="movie-actress movie-info">
                          <h5>Actress : </h5>
                          <p><?php echo $row['actor'] ?></p>
                      </div>

                      <div class="movie-genre movie-info">
                          <h5>Movie genre : </h5>
                          <p><?php echo $row['genre'] ?></p>
                      </div>

                      <div class="movie-release movie-info" >
                          <h5>Day release : </h5>
                          <p><?php echo $row['release_date'] ?></p>
                      </div>

                      <div class="movie-language movie-info">
                          <h5>Language : </h5>
                          <p><?php echo $row['language'] ?></p>
                      </div>
                  </div>

                  <!-- Trailer -->
              <div class="trailer">
                  <iframe width="560" height="315" src="<?php echo $row['trailer'] ?>" 
                  title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                  referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
              </div>
              <!-- End trailer -->

              </div>

              <!-- End product detail -->
            <?php }?>
        </div>

        <!-- carousel start -->
        <div id="carouselRide" class="carousel slide container-fluid " data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="3000">
                <img src="../assets/images/Carousel/furiosa-2048_1716547337203.jpg" width="800" height="500" class="d-block w-100" alt="carou1">
              </div>

              <div class="carousel-item " data-bs-interval="3000">
                <img src="../assets/images/Carousel/carousel2.jpg" width="800" height="500" class="d-block w-100" alt="carou2">
              </div>

              <div class="carousel-item" data-bs-interval="3000">
                <img src="../assets/images/Carousel/doraemon.jpg" width="800" height="500" class="d-block w-100" alt="carou3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselRide" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselRide" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        
        <!-- carousel end -->

        <!-- End main -->

        <!-- Footer -->
        <div class="footer">     
           <p> Copyright &copy; 2024 TDTU</p>
        </div>
        <!-- Footer -->
        
    </div>
</body>
</html>