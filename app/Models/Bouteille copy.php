<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouteille extends Model
{
    //use HasFactory;

    protected $table = 'vino__bouteille';

    /*Si on ajoute ses colonnes 
    public const CREATED_AT = null;
    public const UPDATED_AT = null;*/

    /*Pour l'instant il n'y en a pas */
    public $timestamps = false;


    public function autocomplete($nom, $nb_resultat = 10)
	{

		$rows = array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/", "%", $nom);

	
		$requete = 'SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%' . $nom . '%") LIMIT 0,' . $nb_resultat;
	
		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		} else {
			throw new \Exception("Erreur de requête sur la base de données", 1);
		}


		return $rows;
	}



}
