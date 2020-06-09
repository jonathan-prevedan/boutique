<?php
 include("functions.php");
require_once("header.php");



//INCLUDE DES FONCTIONS AFIN DE REALISER LA CONNEXION

if(isset($_SESSION['username']))
{
	header('location: index.php');
}

//RENVOI VERS LA PAGE 'INDEX' (ACCUEIL) SI L'USER EST CONNECTE !

?>



<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			



            <title>Connexion</title>
	</head>
<body>

	

<h1>Connexion</h1>
<div>
	

			<form action="" method="post">
            <?php
            // VERIFICATION DES DONNES 			
				if(isset($_POST['connect']))
				{
					$user = new user;
					$userconnect= $user->connect($_POST['username'], $_POST['password']);
					if($userconnect=="ok" )
					{
						header('location: index.php');
					}
					else
					{
						echo $userconnect;
					}
					
				}
			?>
				<input type="text" name="username" required placeholder="Login">
				<input type="password" name="password" required placeholder="Password">
				<input type="submit" name="connect" required value="Connexion">
			</form>	
			<a href="register.php"><p>Inscription</p></a>
</div>
<?php 
require_once('footer.php');
?>

	</body>
</html>



