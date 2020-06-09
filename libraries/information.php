<?php include("functions.php");?>
<html>
	<head>
		<title>Information</title>
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
					height:10%;
				}
				.vert
				{
					display:flex;
					flex-direction:column;
					justify-content:space-around;
				}
				.info_cb
				{
					display:flex;
					flex-direction:column;
					justify-content:space-around;
				}
				input
				{
					width:300px;
				}
				
				h1
				{
					padding-top:50px;
					text-align:center;
					color:#CDD6D8;
				}
				h2
				{
					font-size:40px;
					text-align:center;
					color:#CDD6D8;
				}
				
				label
				{
					color:#CDD6D8;
				}
				
				
				</style>
	</head>
<body>
	<?php
	require_once("header.php");
	


	if(!isset($_SESSION['username']))
	{
		header('Location: connexion.php');
	}
	

	$user = new user;
	$panier = new panier;
	$monprofil=$user->infosUser();


	if(isset($_POST['valider_information']))
	{
		$panier->achat($_POST['adresse']);
	}
?>
</br>
<h1>Validation de votre panier</h1>
</br>

<div class="container-fluid">
<h2>Adresse de livraison</h2>
</br>
<div class="row justify-content-around">
	<form action="" method="post">
	
	<fieldset class="vert">
			<label>Entrer ou Valider votre nom</label>
			<input name="nom" required type="text" placeholder="Nom *" value="<?php echo $monprofil[0][3];?>">
			<label>Entrer ou Valider votre prenom</label>
			<input name="prenom"required type="text" placeholder="Prénom *" value="<?php echo $monprofil[0][3];?>">
			<label>Entrer ou Valider votre Email</label>
			<input name="email" required type="email" placeholder="Email *" value="<?php echo $monprofil[0][5];?>">
			<label>Entrer ou Valider votre Adresse</label>
			<input name="adresse" minlength="30" required type="text" placeholder="Votre adresse de livraison *">
	</fieldset>
	

	</br></br>
	<fieldset class="cb">
		<label>Moyen de paiement (Simulation, non requis)</label>
	<div class="moyen_paiement">
		<div class="visa">
			<input checked="true" type="radio" id="visa" name="cb" value="visa">
			<div></div>
  			<label for="visa">VISA</label>
  		</div>
  		<div class="mastercard">
  			<input type="radio" id="mastercard" name="cb" value="mastercard">
  			<div></div>
  			<label for="mastercard">Mastercard</label>
  		</div>
  		<div class="paypal">
  			<input type="radio" id="paypal" name="cb" value="paypal">
  			<div></div>
  			<label for="paypal">Paypal</label>
  		</div>
	  </div>
	  </fieldset>
	  <fieldset class="info_cb">
  	
  		<input type="number" value="4973559965849847" placeholder="N° de carte" name="num_carte">
  		<input type="text" value="Toto" name="name_cb" placeholder="Nom du porteur *">
  		<input type="number" value="845" placeholder="Code sécurité *" min="100" max="999" name="code">
		</fieldset>
		</br>
	  

	
		<input name="valider_information" type="submit" value="Acheter">
	</form>
</div>
</div>
</div>



	
</body>
</html>