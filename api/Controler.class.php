<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler
{
	private $retour = array('data' => array());
	
	/**
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{
		switch ($_GET['requete']) {
			case 'listeBouteille':
				$this->listeBouteille();
				break;
			case 'autocompleteBouteille':
				$this->autocompleteBouteille();
				break;
			case 'ajouterNouvelleBouteilleCellier':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'ajouterBouteilleCellier':
				$this->ajouterBouteilleCellier();
				break;
			case 'boireBouteilleCellier':
				$this->boireBouteilleCellier();
				break;
			default:
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);

				echo json_encode($this->retour);
				break;
		}
	}

	private function listeBouteille()
	{
		$bte = new Bouteille();
		$cellier = $bte->getListeBouteilleCellier();

		$this->retour['data'] = $cellier;

		echo json_encode($this->retour);
	}

	private function autocompleteBouteille()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bte = new Bouteille();
			$listeBouteille = $bte->autocomplete($body->nom);

			$this->retour['data'] = $listeBouteille;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}
	private function ajouterNouvelleBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->ajouterBouteilleCellier($body);

			$this->retour['data'] = $resultat;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	private function boireBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);

			$this->return['data'] = $resultat;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	private function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);

			$this->retour['data'] = $resultat;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($resultat);
	}

	private function erreur($code)
	{
		http_response_code($code);

		return array("message" => "Erreur de requete", "code" => $code);
	}
}
