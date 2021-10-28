<?php

namespace VinoAPI\Modeles;

use Exception;

/**
 * Traite les requêtes des bouteilles à la db.
 */
class BouteilleModele extends Modele
{
	/**
	 * Retourne la bouteille correspondante à l'id.
	 *
	 * @param Integer $id Id de la bouteille.
	 * 
	 * @return Array $rows Bouteille.
	 */
	public function getBouteilleParId($id)
	{
		$rows = array();

		$res = $this->_db->query("SELECT * FROM vino__bouteille LEFT JOIN vino__type ON vino__type_id = vino__type.id WHERE vino__bouteille.id = $id");

		if ($res) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de données", 1);
		}

		return $rows;
	}

	/**
	 * Retourne toutes les bouteilles d'un usager.
	 *
	 * @param Integer $id Id de l'usager.
	 * 
	 * @throws Exception Erreur de requête sur la base de données.
	 * 
	 * @return Array $rows Bouteilles de l'usager.
	 */
	public function getBouteillesParUsagerId($id)
	{
		$rows = array();

		$res = $this->_db->query("SELECT * FROM vino__cellier_inventaire LEFT JOIN vino__bouteille ON vino__cellier_inventaire.bouteille_id = vino__bouteille.id"
			. " LEFT JOIN vino__type ON vino__bouteille.vino__type_id = vino__type.id"
			. " WHERE usager_id = $id");

		if ($res) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de données", 1);
		}

		return $rows;
	}

	/**
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param String $nom La chaine de caractère à rechercher
	 * @param Integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données.
	 * 
	 * @return Array $rows Id et nom de la bouteille trouvée dans le catalogue
	 */
	public function autocomplete($nom, $nb_resultat = 10)
	{
		$rows = array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/", "%", $nom);

		$requete = "(SELECT id, nom, 'SAQ' AS 'Table', NULL AS 'Quantite' FROM vino__bouteille_saq WHERE LOWER(nom) LIKE LOWER('%" . $nom . "%') LIMIT 0," . $nb_resultat . ")"
			. "UNION ALL (SELECT id, nom, 'Cellier' AS 'Table', vino__cellier_inventaire.quantite AS 'Quantite' FROM vino__bouteille"
			. " LEFT JOIN vino__cellier_inventaire ON vino__bouteille.id = vino__cellier_inventaire.bouteille_id"
			. " WHERE LOWER(nom) LIKE LOWER('%" . $nom . "%') LIMIT 0," . $nb_resultat . ");";

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de données", 1);
		}

		return $rows;
	}

	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Object $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean $res Succès ou échec de l'ajout.
	 */
	public function ajouterNouvelleBouteilleCellier($data)
	{
		//TODO : Valider les données.

		$res = false;

		$requeteBte = "INSERT INTO `vino__bouteille` (`usager_id_usager`, `nom`, `pays`, `millesime`, `description`, `url_saq`, `url_img`, `format`, `vino__type_id`, `garde_jusqua`, `note_degustation`, `date_ajout`) VALUES (" .
			"'" . $data->usager_id . "'," .
			"'" . $data->nom . "'," .
			"'" . $data->pays . "'," .
			"'" . $data->millesime . "'," .
			"'" . $data->description . "'," .
			"'" . $data->url_saq . "'," .
			"'" . $data->url_img . "'," .
			"'" . $data->format . "'," .
			"'" . $data->vino__type_id . "'," .
			"'" . $data->garde_jusqua . "'," .
			"'" . $data->note_degustation . "'," .
			"'" . $data->date_ajout . "');";

		$resBte = $this->_db->query($requeteBte);

		if ($resBte) {
			$id = $this->_db->insert_id;

			$requeteInv = "INSERT INTO vino__cellier_inventaire(usager_id, id_cellier, bouteille_id, quantite) VALUES (" .
				"'" . $data->usager_id . "'," .
				"'" . $data->id_cellier . "'," .
				"'" . $id . "'," .
				"'" . $data->quantite . "');";

			$res = $this->_db->query($requeteInv);
		}

		return $res;
	}

	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param Integer $id id de la bouteille
	 * @param Integer $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean $res Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		//TODO : Valider les données.

		$requete = "UPDATE vino__cellier_inventaire SET quantite = GREATEST(quantite + " . $nombre . ", 0) WHERE bouteille_id = " . $id;

		$res = $this->_db->query($requete);

		return $res;
	}
}
