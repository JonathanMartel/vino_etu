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

	/**Modification de l'information de l'usager */
	public function updateProfil($data)
	{
		if (!empty($data['mdpConfirm']) && $data['mdp'] === $data['mdpConfirm']) {
			$mdp = password_hash($data['mdpConfirm'], PASSWORD_DEFAULT);
		}else {
			$mdp = $_SESSION['usager'][0]['mdp'];
		}
		$requete = "UPDATE vino__usager SET nom = '" . $data['nom'] . 
										//"', email='" . $data['email'] . 
										//"', mdp='" . $mdp. 
										"' WHERE id = '" . $_SESSION['usager'][0]['id'] . "'";
		
        $res = $this->_db->query($requete);
        
		return $res;
	}

/* 	public function unUsager($email)
    {
        $requete = "SELECT * FROM vino__usager WHERE email = 'r@r.com'";
		//$requete = "SELECT * FROM vino__usager WHERE email LIKE '".$email. "'";

		$res = $this->_db->query($requete);
       
        return $res;
    } */

	public static function unUsager($courriel)
    {
        $db = static::getDB();
        $sql = 'SELECT * FROM vino__usager WHERE email = :courriel';
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':courriel' => $courriel
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}




?>