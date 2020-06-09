<?php 
include("functions.php");
require_once("header.php");



$produit = new product;
$categorie= new categorie;
$user = new user;

if($user -> infosUser()[0][6] != "admin")
{
	header('Location: index.php');
}

$tabproduits=$produit->produits();
$tab=$produit->categorie();
$tab1=$produit->souscat();
$uti=$user->CmbUser();







if(isset($_POST['modifier']))
{

	 if($_FILES["fileToUpload"]["error"]==0)
	 {
	 	include("upload.php");
	 	$handle=opendir("../img/");
		unlink($_POST['chemin']);
	 }
	 else
	 {	
	 	$_POST['image']= $_POST['chemin'];	
	 }

	$produit->update($_POST['nom'], $_POST['categorie'], $_POST['sous_categorie'], $_POST['description'], $_POST['prix'], $_POST['image'], $_POST['hauteur'], $_POST['largeur'], $_POST['id']);

}

if(isset($_POST['ajout_produit']))
{
	?>
	<div class="uplodad">
		<?php include("add.php");?>
	</div>
	<?php
	
	$chemin="../img/".$name;
	$_POST['image']= $chemin;
	
	
	$produit ->create_produits($_POST['nom'], $_POST['categorie'], $_POST['sous_categorie'], $_POST['description'], $_POST['prix'],$_POST['image'], $_POST['hauteur'], $_POST['largeur']);

}

if(isset($_POST['ajout_categorie']))
{
	$categorie -> ajout_categorie($_POST['nom_categorie']);
}

if(isset($_POST['ajout_sous_categorie']))
{
	?>
	<div class="uplodad">
		<?php include("add.php");?>
	</div>
	<?php
	
	$chemin="../img/".$name;

	$categorie -> ajout_sous_categorie($_POST['nom_sous_categorie'], $chemin, $_POST['hauteur'], $_POST['largeur']);
}


if(isset($_POST['supprimer_categorie']))
{
	$categorie ->delete_categorie($_POST['id_categorie']);
}

if(isset($_POST['supprimer_sous_categorie']))
{
	$handle=opendir("../img/");
	unlink($_POST['chemin_image_sous_categorie']);
	$categorie ->delete_sous_categorie($_POST['chemin_image_sous_categorie']);
}

if(isset($_GET['action']))
{
	$nomproduit=$produit->nameproduits($_GET['nom']);
}

if(isset($_POST['supprimer']))
{
	$produit -> delete($_POST['id']);	
}




?>
<html>
<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="boutique.css" rel="stylesheet">
			<title>Administration</title>
			<style>
				body 
				{
					display:flex;
					flex-direction:column;
					background-color: rgb(37, 62, 99);
					align-items:center;
					text-align:center;
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
				.table
				{
					color:#CDD6D8;
				}
				
				label
				{
					color:#CDD6D8;
				}
				</style>
	</head>

	<body>
	</head>
<body>
</br>
	<h1>Gestion des produits</h1>
			</br>


<div class="option">

	<form action="" method="get">
	<div class="form-group">
    <label for="formGroupExampleInput">Ajouter un produit</label>
    <input class="btn btn-light" name="option" type="submit" value="Ajouter un produit">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Ajouter Catégorie</label>
    <input class="btn btn-light" name="option" type="submit" value="Ajouter Catégorie">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Ajouter une Sous-catégorie</label>
    <input class="btn btn-light" name="option" type="submit" value="Ajouter une Sous-catégorie">
  </div>
		
		
		
	</form>
			
	<form action="" method="get">
	<form action="" method="get">
	<div class="form-group">
    <label for="formGroupExampleInput">Supprimer ou modifier un produit</label>
    <input class="btn btn-light" name="option" type="submit" value="Supprimer ou modifier un produit">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Supprimer une Catégorie</label>
    <input  class="btn btn-light" name="option" type="submit" value="Supprimer une Catégorie">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Supprimer une Sous-catégorie</label>
	<input class="btn btn-light" name="option" type="submit" value="Supprimer une Sous-catégorie">
  </div>
</form>
</div>
			</br>




	<?php

	if(isset($_GET['option']))
	{
	if($_GET['option']=="Ajouter un produit")
	{
	?>
	<div class="adminform">
		<form action="administration.php" method="post" enctype="multipart/form-data">
		<div class="form">
			<input  name="nom" required type="text" placeholder="Nom du Produit">
			<input name="prix" required type="number" min="0.00" max="10000.00" step="0.01" placeholder="prix" />
		</div>
			<textarea name="description" required placeholder="description"></textarea>
			<input required type="file" name="fileToUpload" id="fileToUpload">
			<label>categorie</label>
			<select name="categorie">
				<?php 
				for($i=0; $i < sizeof($tab); $i++)
				{
				?>	
					<option value="<?php echo $tab[$i][0];?>"><?php echo $tab[$i][1];?></option>
				<?php
				}
				?>
			</select>
			<label>sous_categorie</label>
			<select name="sous_categorie">
				<?php 
				for($i=0; $i < sizeof($tab1); $i++)
				{
				?>	
					<option value="<?php echo $tab1[$i][0];?> "><?php echo $tab1[$i][1];?></option>
				<?php
				}
				?>

			</select>
			<div class="taille">
				<label>Hauteur :</label>
				<input name="hauteur" required type="number" value="200">
				<label>Largeur :</label>
				<input name="largeur" required type="number" value="200">
			</div>
			<div class="choix">
				<input class="btn btn-light" type="submit" name="ajout_produit">
			</div>
		</form>
	</div>
	<?php
	}
	else if($_GET['option']=="Supprimer ou modifier un produit")
	{
			?>
		<div class="adminform2">
			<form action="administration.php" method="get">	
				<select name="nom">
					
					<?php for($k=0; $k < sizeof($tabproduits); $k++)
					{
					?>
						<option><?php echo $tabproduits[$k][1];?></option>
					<?php
					}	
					?>
				</select>
					<div class="choix">
						<input class="btn btn-light" type="submit" name="action" value="Valider">
					</div>
			</form>
		</div>
		<?php	
		}
		else if($_GET['option']=="Ajouter Catégorie")
		{
		?>
			<div class="adminform2">
				<form action="administration.php" method="post">
					<input required placeholder="Nom de votre catégorie" type="text" name="nom_categorie">
				<div class="choix">
					<input class="btn btn-light" type="submit" name="ajout_categorie" value="Ajouter">
				</div>
				</form>
			</div>
		<?php
		}
		else if($_GET['option']=="Ajouter une Sous-catégorie")
		{
		?>
			<div class="adminform3">
				<form action="administration.php" method="post" enctype="multipart/form-data">
					<input type="text" required name="nom_sous_categorie" placeholder="Nom de votre sous-categorie">
					<input required type="file" name="fileToUpload" id="fileToUpload">
					<div class="taille">
						<label>Hauteur :</label>
						<input name="hauteur" required type="number" value="200">
						<label>Largeur :</label>
						<input name="largeur" required type="number" value="200">
					</div>
					<div class="choix">
						<input class="btn btn-light" type="submit" name="ajout_sous_categorie" value="Ajouter">
					</div>
				</form>
			</div>
		<?php
		}
		else if($_GET['option']=="Supprimer une Sous-catégorie")
		{
		?>
			<div class="adminform2">
				<form action="administration.php" method="post">
					<select name="chemin_image_sous_categorie">
					
					<?php for($p=0; $p < sizeof($tab1); $p++)
					{
					?>
						<option value="<?php echo $tab1[$p][2];?>"><?php echo $tab1[$p][1];?></option>
						
					<?php
					}
					?>

					</select>	
					<div class="choix">
						<input class="btn btn-light" type="submit" name="supprimer_sous_categorie" value="Supprimer">
					</div>
				</form>
			</div>
		<?php
		}
		else if($_GET['option']=="Supprimer une Catégorie")
		{
		?>
			<div class="adminform2">
				<form action="administration.php" method="post">
					<select name="id_categorie">
					
					<?php for($j=0; $j < sizeof($tab); $j++)
					{
					?>
						<option value="<?php echo $tab[$j][0];?>"><?php echo $tab[$j][1];?></option>
						
					<?php
					}
					?>

					</select>	
					<div class="choix">
						<input class="btn btn-light" type="submit" name="supprimer_categorie" value="Supprimer">
					</div>
				</form>
			</div>
		<?php
		}
		}	
		if(isset($_GET['nom']))
		{
				?>
			<div class="adminform">
				<form action="administration.php" method="post" enctype="multipart/form-data">
				<div class="form">
					<input  name="id" type="hidden" value="<?php echo $nomproduit[0][0];?>">
					<input  name="chemin" type="hidden" value="<?php echo $nomproduit[1][2];?>">
					<input name="nom" required type="text" placeholder="Nom du Produit" value="<?php echo $nomproduit[0][1];?>">
					<input name="prix" required type="number" min="0.00" max="10000.00" step="0.01" placeholder="prix" value="<?php echo $nomproduit[0][5]; ?>"/>
				</div>
					<textarea name="description" required placeholder="description"><?php echo $nomproduit[0][4]; ?></textarea>
					<label>Image actuelle :</label>
					<img width="120px" src="<?php echo $nomproduit[1][2];?>">
					<label>Changer image :</label>
					<input type="file" name="fileToUpload" id="fileToUpload">

					<select name="categorie">

						<?php 
						for($i=0; $i < sizeof($tab); $i++)
						{
						?>	
							<option value="<?php echo $tab[$i][0];?>"><?php echo $tab[$i][1];?></option>
						<?php
						}
						?>

					</select>
					<select name="sous_categorie">
						<?php 
						for($i=0; $i < sizeof($tab1); $i++)
						{
						?>	
							<option value="<?php echo $tab1[$i][0];?> "><?php echo $tab1[$i][1];?></option>
						<?php
						}
						?>

					</select>

					<div class="taille">
						<label>Hauteur :</label>
						<input name="hauteur" required type="number" value="<?php echo $nomproduit[1][3];?>">
						<label>Largeur :</label>
						<input name="largeur" required type="number" value="<?php echo $nomproduit[1][4];?>">
					</div>
					<div class="choix">
						<input class="btn btn-light" type="submit" value="Modifier "name="modifier">
						<input class="btn btn-light" type="submit" value="Supprimer" name="supprimer">
					</div>
				</form>
			</div>
	<?php
		}
	?>
		</section>
	</br>

	<h1>Gestion Des Utilisateurs</h1>
		<table class="table">
		<thead>
			<tr>
				<th scope="col">Rang</th>
				<th scope="col">Pseudo</th>
				<th scope="col">Email</th>
				<th scope="col">Droit</th>
				<th scope="col">Supprimer??</th>
				
			</tr>
		</thead>
		
	<?php
		
		
		foreach($uti as $utili) 
		{ 
			 
	?>
		
		
		
		
		<tbody>
			<tr>
			<td><?php echo $utili[0] ; ?> </td>
			<td><?php echo $utili[1] ; ?> </td>
			<td><?php echo $utili[3] ; ?> </td>
			<td><?php echo $utili[4] ; ?> </td>
			<td>
			<form method="post" action="" id="suppression">
			<button type="submit" id="submit" name="suprr" value ="<?php echo $utili[0];?>">Supprimer</button></form>
			</td>
			</tr>
		</tbody>
	<?php
	if(isset($_POST['suprr']))
	{
		$connect = mysqli_connect("localhost", "root", "", "boutique");
        $delete="DELETE FROM users WHERE id = '".$_POST['suprr']."'";
        $query=mysqli_query($connect,$delete);
		
	}
		}
	?>
		</table> </br>
		</section>
	
	



</body>
</html>