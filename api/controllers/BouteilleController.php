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
				$bte = new BouteilleModele();
				$bouteilles = $bte->getBouteillesParUsagerId($this->urlParams[1]);

				$this->retour['data'] = $bouteilles;
			} else {
				$this->retour['erreur'] = $this->erreur(400);
				unset($this->retour['data']);
			}
		} else if (count($this->urlParams) == 1) {
			$bte = new BouteilleModele();
			$cellier = $bte->getListeBouteilleCellier();

			$this->retour['data'] = $cellier;
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
	public function ajouterBouteilleCellier()
	{
		$body = json_decode(file_get_contents('php://input'));

		if (!empty($body)) {
			$bte = new BouteilleModele();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);

			$this->retour['data'] = $resultat;
		} else {
			$this->retour['erreur'] = $this->erreur(400);
			unset($this->retour['data']);
		}

		echo json_encode($resultat);
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
				$bte = new BouteilleModele();
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
}
