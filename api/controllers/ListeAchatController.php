<?php

namespace VinoAPI\Controllers;

use VinoAPI\Core\Router;
use VinoAPI\Modeles\ListeAchatModele;

/**
 * Gère les méthodes des listes d'achats.
 */
class ListeAchatController extends Router
{
    
    /**
     * Retourne la liste d'achat de l'usager.
     *
     * @return void
     */
    public function getListeAchat()
    {
        if (count($this->urlParams) == 3) {
            if ($this->urlParams[1] == 'usager') {
                if (ctype_digit($this->urlParams[2])) {
                    $listeAchatClassObj = new ListeAchatModele;
                    $resultat = $listeAchatClassObj->getListeAchatParIdUsager($this->urlParams[2]);

                    $this->retour['data'] = $resultat;
                } else {
                    $this->retour['erreur'] = $this->erreur(400);
                    unset($this->retour['data']);
                }
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

    public function createListeAchat() {
        if (count($this->urlParams) == 1) {
            $body = json_decode(file_get_contents('php://input'));

			if (!empty($body)) {
				$listeAchatClassObj = new ListeAchatModele;
				$resultat = $listeAchatClassObj->createListeAchat($body);

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
