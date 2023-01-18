<?php

class Usager extends Modele {
	const TABLE = 'vino__usager';


	public function addUtilisateur($data)
	{
		//TODO : Valider les données.
		//var_dump($data);	
		
		$requete = "INSERT INTO vino__usager (id, email, mdp, nom) VALUES (".
		"'"."0"."',".
		"'".$data['email']."',".
		"'".password_hash($data['mdp'], PASSWORD_DEFAULT)."',".
		"'".$data['nom']."')";

		
        $res = $this->_db->query($requete);
        
		return $res;
	}

}




?>