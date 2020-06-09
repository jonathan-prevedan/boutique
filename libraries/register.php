<?php include("functions.php");
require_once("header.php");

// INCLUDE DES FONCTIONS AFIN DE REALISER LA CONNEXION

if(isset($_SESSION['login']))
{
	header('location: index.php');
}

// RENVOI VERS LA PAGE 'INDEX' (ACCUEIL) SI L'USER EST CONNECTE !

?>

<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="boutique.css" rel="stylesheet">
            <title>Inscription</title>
	</head>
<body>



		

<h1>Inscrivez-vous !</h1>
<div >
		<form action="register.php" method="post">
		<?php
			if(isset($_POST['register']))
			{
				$user = new user;
				$user_sign=$user->register($_POST['username'], $_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['psw1'], $_POST['psw2']);
				if($user_sign=="ok")
				{
					header('location: connexion.php');
				}
				else
				{
					echo $user_sign;
				}
			}
			?>
			<input type="text" name="username" required placeholder="Login">
			<input type="text" name="nom" required placeholder="Nom">
			<input type="text" name="prenom" required placeholder="Prénom">
			<input type="email" name="email" required placeholder="Email">
			<input type="password" name="psw1" required placeholder="Mot de passe">
			<input type="password" name="psw2" required placeholder="Confirmer votre mot de passe">
			<input type="submit" name="register" required value="S'inscrire">
		</form>
</div>


	</body>
</html>


