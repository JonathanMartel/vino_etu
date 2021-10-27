<?php

namespace VinoAPI\Controllers;

use VinoAPI\Core\Router;
use VinoAPI\Modeles\BouteilleModele;
use VinoAPI\Modeles\CellierModele;

/**
 * Gère les méthodes de celliers.
 */
class CellierController extends Router
{
    /**
     * Retourne tous les celliers de l'usager.
     *
     * @return void
     */
    public function getCelliers()
    {
        if (count($this->urlParams) == 2) {
            if (ctype_digit($this->urlParams[1])) {
                $cellierClassObj = new CellierModele;
                $celliers = $cellierClassObj->getCellierParId($this->urlParams[1]);

                $this->retour['data'] = $celliers;
            } else {
                $this->retour['erreur'] = $this->erreur(400);
                unset($this->retour['data']);
            }
        } else if (count($this->urlParams) == 3) {
            if (ctype_digit($this->urlParams[2]) && $this->urlParams[1] == 'usagers') {
                $cellierClassObj = new CellierModele;
                $celliers = $cellierClassObj->getCelliersParUsagerId($this->urlParams[2]);

                $this->retour['data'] = $celliers;
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
     * Ajoute un nouveau cellier.
     *
     * @return void
     */
    public function ajouterNouveauCellier()
    {
        if (count($this->urlParams) == 1) {
            $body = json_decode(file_get_contents('php://input'));

            if (!empty($body)) {
                $cellierClassObj = new CellierModele;
                $resultat = $cellierClassObj->ajouterNouveauCellier($body);

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
