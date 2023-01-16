<!DOCTYPE HTML>
<html>
	
	<head>
		<meta charset="UTF-8" />	
	</head>
	<body>
		<h2>Importation de la SAQ</h2>
		<a href='/'>Retour liste bouteilles</a>
<?php
	

	
	//$saq = SAQ::class;
	//dd($data);
	foreach ($data as $cle => $bouteille) 	//permet d'importer séquentiellement plusieurs pages.
	{
		echo $bouteille['nom'];
		echo "importation : ". $cle. "<br>";
		
		/*echo "<h2>page ". ($page+$i)."</h2>";
		$nombre = SAQ::class->getProduits($nombreProduit,$page+$i);
		echo "importation : ". $nombre. "<br>";*/
	
	}


	
	
	

?>
</body>
</html>