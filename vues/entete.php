<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Vino</title>

	<meta charset="utf-8">
	<meta http-equiv="cache-control" content="no-cache">
	<meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">

	<link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
	<link rel="stylesheet" href="./css/ren.css" type="text/css" media="screen">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sofia+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<base href="<?php echo BASEURL; ?>">
	<script src="./js/plugins.js"></script>
	<script src="./js/main.js"></script>
	<!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
</head>


<body>
	<header>
		<!-- <h1>Cellier - <span class="vino">Vino</span>  - Cellar</h1>  -->

		<div><a href="?requete=accueil"><img src="/vino_etu/img/vino1.jpg" alt="logo" class="logo"></a></div>
		<?php

		if ($_SESSION) echo '<p>Bienvenue ' . $_SESSION['usager'][0]['nom'] . '</p>'
		/* if($_SESSION)echo 'Bienvenue ' . $_SESSION['usager'][0]['nom'] . ' - ' . '<a href="?requete=listecellier" style="color: white; text-decoration: none;">Liste Cellier</a> - <a href="?requete=deconnexion" style="color: white; text-decoration: none;">Déconnexion</a>';	 */
		/* if($_SESSION)echo 'Bienvenue ' . $_SESSION['usager'][0]['nom'] . ' - ' . '<a href="?requete=profil" style="color: white; text-decoration: none;">Profil</a> - <a href="?requete=listecellier" style="color: white; text-decoration: none;">Liste Cellier</a>'; */
		?>


		<nav style="text-decoration: none;">
			<!-- <h3><a href="?requete=cellier">Liste Cellier</a></h3> -->

			<!-- <a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a>  -->
			<!-- <h3><a href="?requete=login" class="btnlogin">Se Connecter</a></h3> -->
		</nav>
	</header>
	<main>