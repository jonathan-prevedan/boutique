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
        <div class="list-group">
          
          <?php  for($i=0; $i < sizeof($affichecat); $i++)
          {
            ?>
            <a href="libraries/sous-cat.php" class="list-group-item"><?php echo $affichecat[$i][1];?></a>
            <?php
          }  ?></a>
        
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          
          <?php 
          
          for($i=0; $i < sizeof($news); $i++)
          {
            ?>
            <div class="col-lg-9">
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="<?php 
              
              
              echo $news[$i][0]; ?>" alt="First slide">
            </div>
            
          </div>
          <?php
          }
          
?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
          <?php 
for($i=0; $i < sizeof($news); $i++)
{
?>
        <div class="row">

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="libraries/description.php?id=<?php echo  $resultat[$i][2];?>"><img height="<?php echo $resultat[$i][5];?>" width="<?php echo $resultat[$i][6];?>" src="<?php echo $resultat[$i][8];?>"><img class="card-img-top" src="<?php $news[$i][0]; ?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $news[$i][1]; ?> </a>
                </h4>
                
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
          <?php
}
          ?>

        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

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
