<?php 
session_start();


// Création d'un 'USER' 

class user
{
    private $id;
    public $username;
    public $nom;
    public $prenom;
    public $email;
    public $password;
    public $cpassword;
    public $role;

// FONCTION DATABASE

    function db(){
    try
    {
        $db = new PDO('mysql:host=localhost;dbname=boutique','root','');
        return($db);
    }
    catch(PDOException $e)
    {
        print 'Erreur : '.$e->getMessage();
    }
}

// FONCTION INSCRIPTION

public function register($username,$nom,$prenom,$email,$password,$cpassword)
{
    $user = $this->db()->query("SELECT * FROM users WHERE username = '$username'");
    $dispo = $user->rowCount();

    if($password != $cpassword || strlen($password) < 4)
		{
			if($password != $cpassword)
			{
				$msg="Mots de passes différents !";
			}
			if(strlen($password) < 5)
			{
				$msg="Mot de passe trop court !";
			}
		}
		else
		{
			if($dispo== 0)
			{ 
				$hash = password_hash($password, PASSWORD_BCRYPT);	
				$requser =  $this->db()->query("INSERT INTO users VALUES(NULL, '$username', '$hash', '$nom','$prenom','$email','visitor')");
				echo $requser;
				$msg="bien vu";
			}
			else
			{
				$msg="Utilisateur deja existant";
			}
        }
        
        return $msg;

}

// FONCTION CONNEXION

public function connect($username,$password)
{
    $user = $this->db()->query("SELECT * FROM users WHERE username ='$username'");
    $info_u= $user->fetch();

    if(password_verify($password,$info_u['password']))
    {
            $this->id=$info_u['id'];
			$this->username=$username;
			$this->password=$info_u['password'];
			$this->nom=$info_u['nom'];
			$this->prenom=$info_u['prenom'];
			$this->email=$info_u['email'];
			$this->role=$info_u['droit'];
		
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$msg="bien vu";
    }
    else
    {
        $msg="Login ou mot de passe incorrect";
    }

    return $msg;
}

// FONCTION MàJ DES INFOS_U

public function update($id,$username,$password,$nom,$prenom,$email,$droit)
{   
	
	$username=$_SESSION['username'];
	$user=$_POST['user'];

	
	if($_SESSION['username'] != $username)
	{			
		$user = $this->db()->query("SELECT *FROM users WHERE login='$username'");
		$dispo = $user->rowCount();
		echo'c';
		
		if($dispo > 0)
		{
			$msg="erreur";	
		}
	}
	else 
	{
		if(strlen($password) >= 5)
		{ 
			
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$update = $this->db()->query("UPDATE users SET username='$user',password='$hash',nom='$nom',prenom='$prenom',email='$email',droit='$droit' WHERE id=$id");
			//UPDATE users SET username='toto',password='',nom='toto',prenom='toto',email='toto@laplateforme.io',droit='admin' WHERE id=2
			
	
		$this->username=$username;
		$this->password=$hash;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->email=$email;
		$this->id=$id;
		
		echo 't';

		$msg = "gg";
		//unset($_SESSION['username']);
		//unset($_SESSION['password']);
		
		// header('location: connexion.php');
		}
		else
		{
			$msg="erreur2";
		}
		
	}	
		return $msg;  
}




// FONCTION RECUPERE TOUTES LES INFOS DE L'USER

public function infosUser()
{
    if(isset($_SESSION['username']))
    {
        $tab=[];
		$user=$_SESSION['username'];
		$infos =  $this->db()->query("SELECT *FROM users WHERE username='$user'");
		
		while($cle = $infos->fetch())
		{
			array_push($tab, $cle);
		}
		
        return $tab;
    }
    else
    {

    	return "Aucun utilisateur n'est connecté";
    }
}
//FONTION RECUPERE TOUT LES UTILIATEURS
public function CmbUser()
{
	 
	$tab=[];
		
		$infos =  $this->db()->query("SELECT *FROM users");
		
		while($cle = $infos->fetch())
		{
			array_push($tab, $cle);
		}
		
        return $tab;
    
}

// FONCTION QUI AFFICHE LES BONNES INFOS

public function reloaded()
{


	$user=$_SESSION['username'];
	$queryuser =  $this->db() ->query("SELECT *from users WHERE username='$user'");
	$donnees = $queryuser->fetch();

	$this->id=$donnees['id'];
	$this->login=$donnees['username'];
	$this->password=$donnees['password'];
	$this->nom=$donnees['nom'];
	$this->prenom=$donnees['prenom'];
	$this->email=$donnees['email'];
	

}

// FONCTION DECONNEXION

public function disconnect()
{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	session_destroy();
	header('location: index.php');
}

// FONCTION SUPPRESION USER

public function delete()
{
	if(isset($_SESSION['username']))
	{
		include('connect.php');
		$user=$_SESSION['username'];
		$del =  $this->db()->query("DELETE FROM users WHERE id='".$_POST['suprr']."'");
		session_destroy();
	}

}

}

// PARTIE PRODUITS 

class product
{
	public $tabcat;
	public $tabsouscat;
	public $tabimg;

	public $nom;
	public $cat;
	public $souscat;
	public $description;
	public $prix;
	public $id;

// FONCTION DATABASE

function db()
{
	try
	{
		$db = new PDO('mysql:host=localhost;dbname=boutique','root','');
		return($db);
	}
	catch(PDOException $e)
	{
		print 'Erreur : '.$e->getMessage();
	}
}


public function categorie()
{
	$tabcat = [];
	$cat =$this->db()->query("SELECT * FROM categorie ORDER BY id ASC");

	
	while($img = $cat->fetch())
	{
		array_push($tabcat, $img);
	}
		$this->tabcat=$tabcat;
		return $tabcat;
}

public function souscat()
{
	$tabsouscat = [];
	$souscat=$this->db()->query("SELECT * FROM souscat ORDER BY id ASC");

		while($img = $souscat->fetch())
		{
			array_push($tabsouscat, $img);
		}
			$this->tabsouscat=$tabsouscat;
			return $tabsouscat;
}

public function images()
{
	$tabimg = [];
	$img=$this->db()->query("SELECT id_souscat, id_categorie, produits.id, nom, prix, h, l, description, chemin FROM produits, images WHERE produits.id=id_produits");

		while($photo = $img->fetch())
		{
			array_push($tabimg, $photo);
		}
			$this->tabimg=$tabimg;
			return $tabimg;
}

public function create_produits($nom,$cat,$souscat,$description,$prix,$img,$hauteur,$largeur)
{
	$verifnom=$this->db()->query("SELECT * FROM produits WHERE nom ='$nom'");
	$result = $verifnom->rowCount();

	if($result == 0)
	{
		$descr = str_replace("'","'",$description);
		$insertpd=$this->db()->query("INSERT INTO produits VALUES(NULL,'$nom','$cat','$souscat','$descr','$prix')");
		$idpd=$this->db()->query("SELECT id FROM produits ORDER BY id DESC");
		$id= $idpd->fetch();

		$numid=$id['id'];
		var_dump($numid);
		$insertimg=$this->db()->query("INSERT INTO images VALUES (NULL,'$numid','$img','$hauteur','$largeur')");
		$msg_ok ="Un nouveau produit vien de faire son apparition !";
	}
	else
	{
		$msg_ok="Le produit existe deja..";
	}
	return $msg_ok;
}

public function produits()
{
	$tabpd = [];
	$numpd = $this->db()->query("SELECT * FROM produits");

		while($numero = $numpd->fetch())
		{
			array_push($tabpd, $numero);
		}
		return $tabpd;
}

public function nameproduits($nom)
{
	$tabpd = [];
	$nompd = $this->db()->query("SELECT * FROM produits WHERE nom='$nom'");

		while($rst = $nompd->fetch())
		{
			array_push($tabpd, $rst);
		}

		$id = $tabpd[0][0];
		$img= $this->db()->query("SELECT * FROM images WHERE id_produits ='$id'");
			while($rst =$img->fetch())
			{
				array_push($tabpd,$rst);
			}
		return $tabpd;
}

public function update($nom, $cat, $souscat, $description, $prix, $img, $hauteur, $largeur, $id)
	{
		$descr=str_replace ( "'","''", $description);
		$updateproduit =  $this->db()->query("UPDATE users SET nom='$nom', id_categorie=$cat, id_souscat=$souscat, description='$descr', prix='$prix' WHERE id=$id");

		$updateimg= $this->db()->query("UPDATE images SET chemin='$img', hauteur='$hauteur', largeur='$largeur' WHERE id_produits='$id'");
		
		header('Location: administration.php');
	}

	public function delete($id)
	{
		$del=$this->db()->query("DELETE FROM produits WHERE id='$id'");
		$del2=$this->db()->query("DELETE FROM images WHERE id_produits='$id'");
		
		$handle=opendir("../img/");	
		unlink($_POST['chemin']);

		header('Location: administration.php');
	}

	public function descriptionproduit()
	{
		if(isset($_GET['id']))
		{
		$id=$_GET['id'];
		$description = $this->db()->query("SELECT chemin, nom, description, prix FROM images, produits WHERE produits.id='$id' and id_produits='$id'");

		return($resultat = $description -> fetch());	
		}
		else
		{
			header('Location: index.php');
		}
	}

	public function nouveautees()
	{
		$tab=[];
		$ajout=$this->db()->query("SELECT chemin, nom, produits.id FROM produits, images WHERE produits.id=id_produits ORDER BY produits.id DESC ");

		while($dernier_ajout = $ajout -> fetch())
		{
			array_push($tab, $dernier_ajout);
		}

		return $tab;
	}

	public function recherche($mot)
	{ 
		$recherhe_mot=$this->db()->query("SELECT id_sous_categorie, id_categorie, produits.id, nom, prix, hauteur, largeur, description, chemin FROM produits, images WHERE produits.id=id_produits and produits.nom LIKE '%".$mot."%'");

		$tab=[];

		while($resultat_recherche = $recherhe_mot -> fetch())
		{
			array_push($tab, $resultat_recherche);
		}

		return($tab);

		
	}

	function genererChaineAleatoire($longueur = 10)
	{
	 $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	 $longueurMax = strlen($caracteres);
	 $chaineAleatoire = '';
	 for ($i = 0; $i < $longueur; $i++)
	 {
	 $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
	 }
	 return $chaineAleatoire;
	}
}




class categorie
{

	function db()
	{
			try
			{
				$db = new PDO('mysql:host=localhost;dbname=boutique','root','');
				return($db);
			}
			catch(PDOException $e)
			{
				print 'Erreur : '.$e->getMessage();
			}
	}

	public function ajout_categorie($nom)
	{
		$insert_categorie=$this->db()->query("INSERT INTO categorie VALUES (NULL, '$nom', '$nom')");
	}

	public function ajout_sous_categorie($nom, $chemin, $hauteur, $largeur)
	{
		$insert_sous_categorie=$this->db()->query("INSERT INTO souscat VALUES (NULL, '$nom', '$chemin', '$hauteur', '$largeur')");
	}

	public function delete_sous_categorie($chemin)
	{

		$delete_sous_categorie=$this->db()->query("DELETE FROM souscat WHERE chemin='$chemin'");
	}

	public function delete_categorie($id)
	{

		$delete_categorie=$this->db()->query("DELETE FROM categorie WHERE id='$id'");
	}

}

class commentaire
{
	function db()
	{
		try
			{
				$db = new PDO('mysql:host=localhost;dbname=boutique','root','');
				return($db);
			}
			catch(PDOException $e)
			{
				print 'Erreur : '.$e->getMessage();
			}
	}

	public function ecrire_avis($com, $id_pd)
	{
		$username = $_SESSION['username'];
		$select_id_user=$this->db()->query("SELECT id FROM users WHERE username ='$username'");
		$user=	$select_id_user->fetch(PDO::FETCH_ASSOC);
		
		$userid = $user['id'];
		$addcom = $this->db()->query("INSERT INTO avis (commentaire, id_produits, id_users) VALUES ('$com','$id_pd','$userid')");
	}

	public function avis($id_pd)
	{
		$select_avis=$this->db()->query("SELECT avis.id, username,commentaire,date,id_users FROM avis, users WHERE id_produits='$id_pd' and id_users=users.id ORDER BY avis.id ASC");

		$tbavis = [];

			while($avis = $select_avis->fetch())
			{
				array_push($tbavis,$avis);
			}
			return $tbavis;
	}

	public function byeavis()
	{
		$suppr = $this->db()->query("DELETE FROM avis WHERE id = '$id'");
	}
}

class panier
{
	function db()
	{
		try
			{
				$db = new PDO('mysql:host=localhost;dbname=boutique','root','');
				return($db);
			}
			catch(PDOException $e)
			{
				print 'Erreur : '.$e->getMessage();
			}
	}
	
	public function create_cart($id,$qte,$prix)
	{
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
			$select_id_user=$this->db()->query("SELECT id FROM users WHERE username ='$username'");

			$rst_user= $select_id_user->fetch(PDO::FETCH_ASSOC);
			$id_user=$rst_user['id'];
			$cart=$this->db()->query("INSERT INTO panier VALUES(NULL,'$id_user','$id','$qte','$prix')");
			header('Location: cart.php');
		}
		else
		{
			header('Location: index.php');
		}

	}

	public function cart()
	{
		$tabcart= [];
		$username = $_SESSION['username'];
		$select_id_user=$this->db()->query("SELECT id FROM users WHERE username ='$username'");
		$rst_user= $select_id_user->fetch(PDO::FETCH_ASSOC);
		$id_user=$rst_user['id'];

		$cart=$this->db()->query("SELECT * FROM panier, images, produits WHERE id_utilisateurs='$id_user' and panier.id_produits=images.id_produits and panier.id_produits=produits.id ORDER BY panier.id ASC");

			while($echocart = $cart->fetch())
			{
				array_push($tabcart,$echocart);
			}
			return $tabcart;
	}

	public function delete($id)
	{
		$delete=$this->db()->query("DELETE FROM panier WHERE id='$id' ORDER by id ASC");
		
	}

	public function commande($adresse)
	{
		$username=$_SESSION['username'];
		$select_id_user->$this->db()->query("SELECT id FROM users WHERE username ='$username'");
		$rst_user= $select_id_user->fetch(PDO::FETCH_ASSOC);
		$id_user=$rst_user['id'];

		$pd_cart=$this->db()->query("SELECT * FROM panier WHERE id.users ='$id_user'");

		$cart = [];

			while($product = $pd_cart->fetch())
			{
				array_push($cart, $product);
			}

			for($i=0; $i< sizeof($cart); $i++)
			{
				$id_utilisateur = $cart[$i][1];
				$id_produit = $cart[$i][2];
				$qte = $cart[$i][3];
				$prix = $cart[$i][4];
				
				$commande=$this->db()->query("INSERT INTO commande VALUES ('$id_utilisateur','$id_produit','$qte','$adresse')");
			}
				$delete=$this->db()->query("DELETE DROM panier WHERE id.users='$id_user'");
				
				header('Location: commande.php');
	}

	public function select_command()
	{
		$tabcommand = [];
		$username=$_SESSION['username'];
		$select_id_user->$this->db()->query("SELECT id FROM users WHERE username ='$username'");
		$rst_user= $select_id_user->fetch(PDO::FETCH_ASSOC);
		$id_user=$rst_user['id'];

		$thecommande=$this->db()->query("SELECT * FROM commande, images, produits WHERE id_users='$id_user' and commande.id_produits=images.id_produits and commande.id_produits=produits.id ORDER BY commande.id ASC");
		
			while($commande = $thecommande->fetch())
			{
				array_push($tabcommand, $commande);
			}
			return $tabcommand;
	}

	public function suppr_command()
	{
		$delete=$this->db()->query("DELETE FROM commande id='$id' ORDER BY id ASC");
	}

	public function top()
	{
		$select_vente=$this->db()->query("SELECT nom, chemin, commande.id_produits FROM commande, produits, images WHERE commande.id_produits=produits.id and commande.id_produits=images.id_produits ORDER BY commande.id ASC");

		$tab_vente=[];

		while($vente = $select_vente->fetch())
		{
			array_push($tab_vente,$vente);
		}
		return $tab_vente;
	}
}

?>