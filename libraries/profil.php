<?php include("functions.php");
require_once("header.php");




// if(!isset($_SESSION['username']))
// {
// 	header('Location: index.php');
// }



$user = new user;
$infos_user=$user->infosUser();



?>

<!-- ---------------------------------------------- -->
<!-- ---------- FORMULAIRE HTML-------------------- -->

<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="boutique.css" rel="stylesheet">
			<title>Modification profil</title>
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
					padding-top:50px;
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
				label
				{
					color:#CDD6D8;
				}
				.form-control
				{
				width:500px;
				}
				</style>
	</head>

	<body>
		
	</br>
<h1 class="log_titre">Vos informations</h1>
</br>
<div class="container-fluid">
<div class="row justify-content-around">
<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <p class="card-text">Bienvenue dans votre espace <b><?php echo $infos_user[0][1];?></b> ici vous pouvez modifier vos données personelles</p>
  </div>
</div>
			</br>
<div id="form_log2">
		<form action="" method="post">
		<div class="form-group">
    <label for="formGroupExampleInput">Login</label>
    <input type="text" class="form-control" name="user" required placeholder="Login" value="<?php echo $infos_user[0][1]; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Password</label>
    <input type="password" class="form-control" name="psw" required placeholder="Password" value="<?php echo $infos_user[0][2];?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Nom</label>
    <input type="text" class="form-control" name="nom" required placeholder="Nom" value="<?php echo $infos_user[0][3]; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Prenom</label>
    <input type="text" class="form-control" name="prenom" required placeholder="Prénom" value="<?php echo $infos_user[0][4]; ?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Email</label>
    <input type="text" class="form-control"name="email" required placeholder="Email" value="<?php echo $infos_user[0][5];?>">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Valider vos changements</label>
	<input class="btn btn-light" type="submit" name="change" required value="Modifier">
  </div>
		<?php
		
			if(isset($_POST['change']))
				{
					
					$id=$infos_user[0]['id'];
					$droit=$infos_user[0]['droit'];

					$profil_update=$user->update($id,$_POST['user'], $_POST['psw'], $_POST['nom'], $_POST['prenom'], $_POST['email'],$droit);
					
					if($profil_update == "erreur")
					{
						?><p>Login déjà existant</p><?php
					}
					else if($profil_update == "erreur2")
					{
						?><p>Mot de passe trop court (5 caractères minimums)</p><?php
					}
				}	
		?>
			
		</form>
</div>	
</div>
			</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>