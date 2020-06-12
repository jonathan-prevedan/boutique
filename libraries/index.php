<?php 

include("functions.php");
include("header.php");

$categorie = new product;
$affichecat=$categorie->categorie();
$news =$categorie->nouveautees();

$resultat = $categorie->images();



?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Bootstrap core CSS -->
 <link href="bootstrap//vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->

<link href="libraries/boutique.css" rel="stylesheet">
  <title>Accueil 2Chuz'</title>



</head>

<body>


  <!-- Page Content -->
  <div class="container">
    <p>NOS NOUVEAUTEES</p>
    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4">2Chuz'</h1>
        <div class="list-group list-group-horizontal">

          
          <?php  for($i=0; $i < sizeof($affichecat); $i++)
          {
            ?>
            <a href="sous-cat.php?id=<?php echo  $affichecat[$i][0];?>" class="list-group-item"><?php echo $affichecat[$i][1];?></a>
            <?php
          }  ?></a>
        
        </div>

      </div>
      <!--carrousel -->

      
          
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  </br></br>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-10" src="<?php echo $news[0][0];?>" width="100%" height="600px" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $news[0][1]; ?></h5>
   
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo $news[0][0] ; ?>" width="500px" height="600px"  alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $news[0][1];?></h5>
    
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="<?php echo $news[0][0]; ?>" width="500px" height="600px"  alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
      <h5><?php echo $news[0][1];?></h5>
    
    </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="bootstrap/vendor/jquery/jquery.min.js"></script>
  <script src="bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
