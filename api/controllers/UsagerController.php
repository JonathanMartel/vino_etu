<?php

namespace VinoAPI\Controllers;

use VinoAPI\Core\Router;
use VinoAPI\Modeles\UsagerModele;

/**
 * Gère les méthodes de bouteilles.
 */
class UsagerController extends Router
{
    /**
     * Teste le login usager.
     *
     * @return void
     */
    public function login()
    {
        if (count($this->urlParams) == 2) {
            if ($this->urlParams[1] == 'login') {
                $body = json_decode(file_get_contents('php://input'));

                if (!empty($body)) {
                    //TODO valider données

                    $usagerClassObj = new UsagerModele;
                    $resultat = $usagerClassObj->match($body->courriel, $body->mot_passe);

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
}
