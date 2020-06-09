<?php include("functions.php");
require_once("header.php");?>

<html>
	<head>
		<title>Mon panier</title>
		<link href="boutique.css" rel="stylesheet">
		<meta charset="UTF-8">
		<style>
				body 
				{
					background-color: rgb(37, 62, 99);
					color:#CDD6D8;
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
					padding-top:50px;
					text-align:center;
					color:#CDD6D8;
				}
				.table
				{
					color:#CDD6D8;
				}
				label
				{
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


	
	<?php $panier = new panier; ?>


<!-- Supprimer du panier -->

<?php

	if(!isset($_SESSION['username']))
	{
		header('Location: connexion.php');
	}

	if(isset($_POST['suppr']))
	{
		$panier ->delete($_POST['produit']);
	}

	
	$cart=$panier -> cart();

	?></br><h1>Votre panier </h1></br>
	<div class="card" style="width: 18rem;">
	<img src="..." class="card-img-top" alt="...">
	<div class="card-body">
	  <p class="card-text">Bienvenue dans votre panier <b><?php echo $infos_user[0][1];?></b> retrouvez ici vos commandes a valider</p>
	</div>
  </div>
  </br>
  <?php

if(sizeof($cart) == 0)
{
?>

	<h1 class="panier_vide">Panier vide</h1>
	<div class="image_bonhomme">
		
	</div>
<?php
}
else
{
?>
	<div class="infos_panier">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Image produit</th>
					<th scope="col">Nom du produit</th>
					<th scope="col">Quantité</th>
					<th scope="col">Prix</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>

			<?php
			$a=0;
			$tab_cart=[];
			for($i=0; $i < sizeof($cart); $i++)
			{
               
				?>
				<tbody>
				<tr>
					<!-- Image produit -->
					<td><img width="80px" src="<?php echo $cart[$i][7];?>"></td>
					<!-- Nom du produi -->
					<td><?php echo $cart[$i][11];?></td>
					<!-- Quantité produit -->
					<td><?php echo $cart[$i][3];?></td>
					<!-- Prix -->
					<td><?php echo $cart[$i][4]*$cart[$i][3]. " €";?></td>
					<!-- Calcul prix total du panier -->
					<?php $a=$a+$cart[$i][4]*$cart[$i][3];?>
					<!-- Supprimer élément -->
					<td>
						<form class="corbeille" method="post" action="">
							<input type="hidden" name="produit" value="<?php echo $cart[$i][0]; ?>">
							<input class="btn btn-light" type="submit" value="" name="suppr">
						</form>
					</td>
				</tr>

			<?php
			}
			?>
			</tbody>
		</table>
	</div>
		</br>
	<div class="prix_total">
		<div class="valid_panier">
			<div><?php echo "Prix total : ".$a. " €"; ?></div>
			<form method="post" action="information.php">
				<input class="btn btn-light" type="submit" name="valider" value="Valider mon panier">
			</form>
		</div>
	</div>
<?php
}


	?>
</body>
</html>