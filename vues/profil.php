
<h1>Votre Profil</h1>

<?php
	
	if($_SESSION){
		echo '<p>Numero ID: ' . $_SESSION['usager'][0]['id'] . '</p>';
		echo '<p>Nom: ' . $_SESSION['usager'][0]['nom'] . '</p>';
		echo '<p>Email: ' . $_SESSION['usager'][0]['email'] . '</p>';
	}
?>

<a href="?requete=profilmod" class="btnlogin button-28">Mofifier son profil</a>


