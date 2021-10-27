<?php

namespace VinoAPI\Core;

use VinoAPI\Controllers\BouteilleController;
use VinoAPI\Controllers\CellierController;
use VinoAPI\Controllers\SAQController;
use VinoAPI\Controllers\UsagerController;
use VinoAPI\Modeles\UsagerModele;

/**
 * Classe qui gère et redirige chaque requête à son controller.
 */
class Router
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
	 * @var Array
	 */
	private $retour = array('data' => array());

	/**
	 * Traite les requêtes.
	 * 
	 * @return void
	 */
	public function gerer()
	{
		if (!$this->validerAuthentification()) {
			$this->retour['erreur'] = $this->erreur(401);
			unset($this->retour['data']);
			echo json_encode($this->retour);
			return true;
		}

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
				case 'usagers':
					echo json_encode('usagers');
					break;
				case 'bouteilles':
					$bouteilleClassObj = new BouteilleController;
					$bouteilleClassObj->getBouteilles();
					break;
				case 'celliers':
					$cellierClassObj = new CellierController;
					$cellierClassObj->getCelliers();
					break;
				case 'saq':
					$saqClassObj = new SAQController;
					$saqClassObj->autocompleteBouteille();
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
			case 'usagers':
				echo json_encode('usagers');
				break;
			case 'bouteilles':
				$bouteilleClassObj = new BouteilleController;
				$bouteilleClassObj->ajouterNouvelleBouteilleCellier();
				break;
			case 'celliers':
				$cellierClassObj = new CellierController;
				$cellierClassObj->ajouterNouveauCellier();
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
		switch ($this->urlParams[0]) {
			case 'usagers':
				$usagerClassObj = new UsagerController;
				$usagerClassObj->login();
				break;
			case 'bouteilles':
				$bouteilleClassObj = new BouteilleController;
				$bouteilleClassObj->modifierQuantiteBouteilleCellier();
				break;
			case 'celliers':
				echo json_encode('celliers put');
				break;
			case 'saq':
				echo json_encode('saq put');
				break;
			default:
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
				echo json_encode($this->retour);
				break;
		}
	}

	/**
	 * Traite les requêtes DELETE
	 *
	 * @return void
	 */
	private function deleteAction()
	{
		switch ($this->urlParams[0]) {
			case 'usagers':
				echo json_encode('usagers delete');
				break;
			case 'bouteilles':
				echo json_encode('bouteilles delete');
				break;
			case 'celliers':
				echo json_encode('celliers delete');
				break;
			case 'saq':
				echo json_encode('saq delete');
				break;
			default:
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
				echo json_encode($this->retour);
				break;
		}
	}

	/**
	 * Valide l'authentification HTTP.
	 *
	 * @return Boolean $access Authentification.
	 */
	public function validerAuthentification()
	{
		$access = false;
		$headers = apache_request_headers();

		if (isset($headers['authorization'])) {
			if (isset($_SERVER['PHP_AUTH_PW']) && isset($_SERVER['PHP_AUTH_USER'])) {
				if ($_SERVER['PHP_AUTH_PW'] == 'vino' && $_SERVER['PHP_AUTH_USER'] == 'vino') {
					$access = true;
				}
			}
		}
		return $access;
	}

	/**
	 * Affiche une erreur http et return une array avec le code d'erreur.
	 *
	 * @param int $code
	 * 
	 * @return Array Erreur de requête HTTP.
	 */
	public function erreur($code)
	{
		http_response_code($code);

		return array("message" => "Erreur de requete", "code" => $code);
	}
}
