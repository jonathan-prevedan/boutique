<!DOCTYPE html>
    <html lang="fr">
	    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="boutique.css" rel="stylesheet">
			<title>sous_cat</title>
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
<?php include("functions.php");
require_once("header.php");?>

			</br></br></br>
<div class="container-fluid">
<div class="sous_categorie">
	<div>
		<?php
		$produit = new product;
		$tab=$produit -> categorie();
		$tab1=$produit -> souscat();
		
		

			for($i=0; $i < sizeof($tab1); $i++)
			{
				
			?><div class="row justify-content-center">
			<a href="produits.php?type="><img width="<?php echo $tab1[$i][4];?>" src="<?php echo $tab1[$i][2];?>"><?php echo $tab1[$i][1];?></a>
			</div><?php
			}
			?>
	</div>
</div>



</body>
</html>


