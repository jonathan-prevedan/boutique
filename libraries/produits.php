<?php include("functions.php");
require_once("header.php");?>






<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="icon" type="image/png" href="img/476a5038defea9f3fa86cb13e9ebeb2d.png"/>
            <link href="boutique.css" rel="stylesheet">
			<title>PRODUITS</title>
			<style>
				body 
				{
					background-color: rgb(37, 62, 99);
				}
				.row 
				{
					display:flex;
					flex-wrap:wrap;
					width:100%;
					height:40%;
				}
				h1
				{
					padding-top:55px;
					text-align:center;
					color:#CDD6D8;
				}
				.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    /* border: 1px solid rgba(0,0,0,.125); */
    border-radius: .75rem;
	BOX-SHADOW: 1px 1px 1px 1px #CDD6D8;
	background-color:#5370A5;
				}
				</style>
	</head>
<body>
	<?php 

$produit= new product();

if(isset($_GET['search']))
{
	$resultat=$produit->recherche($_GET['search']);
}
?>

<div class="barre_recherche">
	<form method="get" action="">
		<input placeholder="Votre recherche" name="search" type="text">
		<input type="submit" value="Rechercher">
	</form>
</div>
</br>
<h1>Nos Produits</h1>
</br>


<div class="container-fluid">
	<div class="row justify-content-around">


<?php


$image=$produit -> images();

if(isset($_GET['search']))
{
	if(sizeof($resultat)==0)
	{
	?>
	
		<div class="hover_produits1">
			<p>La recherhe n'a retournée aucun résultat</p>
		</div>
	<?php
	}
	for($i=0; $i < sizeof($resultat); $i++)
	{
		
	?>
		
		<div class="hover_produits">
			<a href="description.php?id=<?php echo  $resultat[$i][2];?>"><img height="<?php echo $resultat[$i][5];?>" width="<?php echo $resultat[$i][6];?>" src="<?php echo $resultat[$i][8];?>"></a>
		</div>
	<?php
	}
}

else if(!isset($_GET['id']) && !isset($_GET['id2']))
{

	for($i=0; $i < sizeof($image); $i++)
	{
	
		
	
	?>

	<div class="card" style="width: 20rem;">
	<div class="hover_produits">
			
		</div>
  <img height="<?php echo $image[$i][5];?>" width="<?php echo $image[$i][6];?>"  src="<?php echo $image[$i][8];?>" class="card-img-top" width="50px">
  <div class="card-body">
	<h5 class="card-title"><?php echo $image[$i][3];?></h5>
	<hr>
	<p class="card-text"><?php echo $image[$i][7];?></p>
	<p class="card-text"><b><?php echo $image[$i][4];?> Euros</b></p>
    
	<a class="btn btn-light" href="description.php?id=<?php echo $image[$i][2];?>">Voir plus</a>
  </div>
</div>
	
		
	<?php
	}
}
else if(!isset($_GET['id']) || !isset($_GET['id2']))
{
	header('Location: index.php');

}
else 
{
	for($i=0; $i < sizeof($image); $i++)
	{
	if($_GET['id']== $image[$i][1] && $_GET['id2']==  $image[$i][0])
	{
		
	?>
	<div class="hover_produits">
		<a href="description.php?id=<?php echo  $image[$i][2];?>"><img height="<?php echo $image[$i][5];?>" width="<?php echo $image[$i][6];?>" src="<?php echo $image[$i][8];?>"></a>
	</div>
	<?php
	}
	}

}
?>
</div>
<div>
</div>






<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
