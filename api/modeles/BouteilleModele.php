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
	 * @return Array Bouteille.
	 */
	public function getBouteilleParId($id)
	{
		$rows = array();

		$res = $this->_db->query("SELECT * FROM vino__cellier_inventaire WHERE usager_id = $id");

		if ($res->num_rows) {
			while ($row = $res->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return $rows;
	}

	/**
	 * Retourne toutes les bouteilles d'un usager.
	 *
	 * @param mixed $id Id de l'usager.
	 * 
	 * @return Array Bouteilles de l'usager.
	 */
	public function getBouteillesParUsagerId($id)
	{
		$rows = array();

		$res = $this->_db->query("SELECT * FROM vino__cellier_inventaire LEFT JOIN vino__bouteille ON vino__cellier_inventaire.bouteille_id = vino__bouteille.id WHERE usager_id = $id");

		if ($res->num_rows) {
			while ($row = $res->fetch_assoc()) {
				$rows[] = $row;
			}
		}

		return $rows;
	}

	/**
	 * Méthode qui retourne toutes les bouteilles dans tous les celliers.
	 *
	 * @throws Exception Erreur de requête sur la base de données.
	 * 
	 * @return Array Liste de bouteilles dans les celliers.
	 */
	public function getListeBouteilleCellier()
	{
		$rows = array();

		$requete = 'SELECT 
						c.id as id_bouteille_cellier,
						c.id_bouteille, 
						c.date_achat, 
						c.garde_jusqua, 
						c.notes, 
						c.prix, 
						c.quantite,
						c.millesime, 
						b.id,
						b.nom, 
						b.type,  
						b.code_saq, 
						b.url_saq, 
						b.pays, 
						b.description,
						t.type 
						from vino__cellier c 
						INNER JOIN vino__bouteille_saq b ON c.id_bouteille = b.id
						INNER JOIN vino__type t ON t.id = b.type
						';

		if (($res = $this->_db->query($requete)) ==	 true) {
			if ($res->num_rows) {
				while ($row = $res->fetch_assoc()) {
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
				}
			}
		} else {
			throw new Exception("Erreur de requête sur la base de donnée", 1);
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
	 * @return Array Id et nom de la bouteille trouvée dans le catalogue
	 */

	public function autocomplete($nom, $nb_resultat = 10)
	{
		$rows = array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/", "%", $nom);

		$requete = "(SELECT id, nom, 'SAQ' AS 'TABLE' FROM vino__bouteille_saq where LOWER(nom) LIKE LOWER('%" . $nom . "%') LIMIT 0," . $nb_resultat . ")"
			. "UNION ALL (SELECT id, nom, 'Cellier' AS 'TABLE' FROM vino__bouteille where LOWER(nom) LIKE LOWER('%" . $nom . "%') LIMIT 0," . $nb_resultat . ");";

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
	 * @param String $cellier Nom du celier à modifier.
	 * @param Integer $usagerId Id de l'usager propriétaire du cellier.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data, $cellier = null, $usagerId = null)
	{
		//TODO : Valider les données.

		$requete = "INSERT INTO vino__cellier(date_achat,garde_jusqua,notes,prix,quantite,millesime) VALUES (" .
			"'" . $data->date_achat . "'," .
			"'" . $data->garde_jusqua . "'," .
			"'" . $data->notes . "'," .
			"'" . $data->prix . "'," .
			"'" . $data->millesime . "')";

		$res = $this->_db->query($requete);

		return $res;
	}

	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param Integer $id id de la bouteille
	 * @param Integer $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		//TODO : Valider les données.

		$requete = "UPDATE vino__cellier SET quantite = GREATEST(quantite + " . $nombre . ", 0) WHERE id = " . $id;

		$res = $this->_db->query($requete);

		return $res;
	}
}
