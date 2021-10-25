<?php

namespace VinoAPI\Controllers;

use VinoAPI\Core\Router;
use VinoAPI\Modeles\BouteilleModele;

/**
 * Gère les méthodes de bouteilles.
 */
class BouteilleController extends Router
{
	/**
	 * Retourne toutes les bouteilles dans les celliers.
	 *
	 * @return void
	 */
	public function getBouteilles()
	{
		if (count($this->urlParams) == 2) {
			if (ctype_digit($this->urlParams[1])) {
				$bteClassObj = new BouteilleModele;
				$bouteilles = $bteClassObj->getBouteilleParId($this->urlParams[1]);

				$this->retour['data'] = $bouteilles;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else if (count($this->urlParams) == 3) {
			if ($this->urlParams[1] == 'usager' && ctype_digit($this->urlParams[2])) {
				$bteClassObj = new BouteilleModele;
				$bouteilles = $bteClassObj->getBouteillesParUsagerId($this->urlParams[2]);

				$this->retour['data'] = $bouteilles;
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
	 * Change la quantité d'une bouteille.
	 *
	 * @return void
	 */
	public function modifierQuantiteBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bteClassObj = new BouteilleModele;
			$resultat = $bteClassObj->modifierQuantiteBouteilleCellier($body->id, $body->quantite);

			$this->retour['data'] = $resultat;
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
	public function ajouterNouvelleBouteilleCellier()
	{
		if (count($this->urlParams) == 1) {
			$body = json_decode(file_get_contents('php://input'));

			if (!empty($body)) {
				$bteClassObj = new BouteilleModele;
				$resultat = $bteClassObj->ajouterNouvelleBouteilleCellier($body);

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
}
