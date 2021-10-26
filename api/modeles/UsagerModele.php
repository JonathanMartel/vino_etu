<?php

namespace VinoAPI\Modeles;

use Exception;

/**
 * Gère les requêtes d'usagers.
 */
class UsagerModele extends Modele
{
    /**
     * Retourne si l'authorisation HTTP match un usager à la db.
     *
     * @param String Courriel de l'usager.
     * @param String Mot de passe de l'usager.
     * 
     * @throws Exception Erreur de requête sur la base de données.
     *  
     * @return Boolean Authentification valide.
     */
    public function match($courriel, $password)
    {
        $requete = "SELECT  FROM vino__usager WHERE courriel = $courriel AND password_usager = '$password'";
        $match = false;

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                $match = true;
            } else {
                $match = false;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $match;
    }
}
