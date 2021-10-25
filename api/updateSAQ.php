<!-- //TODO convertir ce fichier en méthode de modèle -->
<!DOCTYPE HTML>
<html>

<head>
	<meta charset="UTF-8" />
</head>

<body>
	<?php

require("./core/Autoloader.php");
use VinoAPI\Core\Autoloader;

Autoloader::register();
use VinoAPI\Libs\SAQ;

require("./config/dataconf.php");
	$page = 1;
	$nombreProduit = 24; //48 ou 96	

	$saq = new SAQ();
	for ($i = 0; $i < 1; $i++)	//permet d'importer séquentiellement plusieurs pages.
	{
		echo "<h2>page " . ($page + $i) . "</h2>";
		$nombre = $saq->getProduits($nombreProduit, $page + $i);
		echo "importation : " . $nombre . "<br>";
	}
	?>
</body>

</html>