<?php

/**
 * Gère les requêtes HTTP.
 */
class Controller
{
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->urlElements = parse_url($_SERVER['REQUEST_URI']);
		$this->urlParams = array_slice(explode('/', trim($this->urlElements['path'], '/')), 2);
	}

	/**
	 * Array qui contient les erreurs et le data de chaque requête.
	 *
	 * @var array
	 */
	private $retour = array('data' => array());

	/**
	 * Traite les requêtes.
	 * @return void
	 */
	public function gerer()
	{
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				$this->getAction();
				break;
			case 'POST':
				$this->postAction();
				break;
			case 'PUT':
				$this->putAction();
				break;
			case 'PATCH':
				$this->patchAction();
				break;
			case 'DELETE':
				$this->deleteAction();
				break;
			default:
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
				echo json_encode($this->retour);
				break;
		}
	}

	/**
	 * Traite les requêtes GET.
	 *
	 * @return void
	 */
	private function getAction()
	{
		if (isset($this->urlParams[0])) {
			switch ($this->urlParams[0]) {
				case 'users':
					echo json_encode('users');
					break;
				case 'bouteilles':
					$this->getBouteilles();
					break;
				case 'celliers':
					$this->getCelliers();
					break;
				case 'saq':
					$this->autocompleteBouteille();
					break;
				default:
					$this->retour['erreur'] = $this->erreur(400);
					unset($this->retour['data']);
					echo json_encode($this->retour);
					break;
			}
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
			echo json_encode($this->retour);
		}
	}

	/**
	 * Traite les requêtes POST.
	 *
	 * @return void
	 */
	private function postAction()
	{
		switch ($this->urlParams[0]) {
			case 'users':
				echo json_encode('users');
				break;
			case 'bouteilles':
				$this->ajouterNouvelleBouteilleCellier();
				break;
			case 'celliers':
				$this->ajouterNouveauCellier();
				break;
			case 'saq':
				echo json_encode('saq');
				break;
			default:
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
				echo json_encode($this->retour);
				break;
		}
	}

	/**
	 * Traite les requêtes PUT.
	 *
	 * @return void
	 */
	private function putAction()
	{
	}

	/**
	 * Traite les requêtes PATCH.
	 *
	 * @return void
	 */
	private function patchAction()
	{
	}

	/**
	 * Traite les requêtes DELETE
	 *
	 * @return void
	 */
	private function deleteAction()
	{
	}

	/**
	 * Retourne toutes les bouteilles dans les celliers.
	 *
	 * @return void
	 */
	private function getBouteilles()
	{
		if (count($this->urlParams) == 2) {
			if (ctype_digit($this->urlParams[1])) {
				$bte = new Bouteille();
				$bouteilles = $bte->getBouteillesParUsagerId($this->urlParams[1]);

				$this->retour['data'] = $bouteilles;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else if (count($this->urlParams) == 1) {
			$bte = new Bouteille();
			$cellier = $bte->getListeBouteilleCellier();

			$this->retour['data'] = $cellier;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}
	
	/**
	 * Retourne tous les celliers de l'usager.
	 *
	 * @return void
	 */
	private function getCelliers() {
		if (count($this->urlParams) == 2) {
			if (ctype_digit($this->urlParams[1])) {
				$cellier = new Cellier();
				$celliers = $cellier->getCelliersParUsagerId($this->urlParams[1]);

				$this->retour['data'] = $celliers;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else if (count($this->urlParams) == 1) {
			$bte = new Bouteille();
			$cellier = $bte->getListeBouteilleCellier();

			$this->retour['data'] = $cellier;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	/**
	 * Retourne les bouteilles qui matchent la recherche actuelle de l'usager.
	 *
	 * @return void
	 */
	private function autocompleteBouteille()
	{
		if (count($this->urlParams) == 2) {
			$body = array_slice(explode('/', $_SERVER['QUERY_STRING']), 1);

			if (!empty($body)) {
				$bte = new Bouteille();
				$listeBouteille = $bte->autocomplete($body[0]);

				$this->retour['data'] = $listeBouteille;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	/**
	 * Ajoute une nouvelle bouteille au cellier.
	 *
	 * @return void
	 */
	private function ajouterNouvelleBouteilleCellier()
	{
		if (count($this->urlParams) == 1) {
			$body = json_decode(file_get_contents('php://input'));

			if (!empty($body)) {
				$bte = new Bouteille();
				$resultat = $bte->ajouterBouteilleCellier($body);

				$this->retour['data'] = $resultat;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	/**
	 * Réduit la quantité de la bouteille de 1.
	 *
	 * @return void
	 */
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

	/**
	 * Augmente la quantité de la bouteille de 1.
	 *
	 * @return void
	 */
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

	/**
	 * Ajoute un nouveau cellier.
	 *
	 * @return void
	 */
	private function ajouterNouveauCellier()
	{
		if (count($this->urlParams) == 1) {
			$body = json_decode(file_get_contents('php://input'));

			if (!empty($body)) {
				$bte = new Cellier();
				$resultat = $bte->ajouterNouveauCellier($body);

				$this->retour['data'] = $resultat;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($this->retour);
	}

	/**
	 * Affiche une erreur http et return une array avec le code d'erreur.
	 *
	 * @param mixed $code
	 * @return void
	 */
	private function erreur($code)
	{
		http_response_code($code);

		return array("message" => "Erreur de requete", "code" => $code);
	}
}
