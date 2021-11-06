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

        $match = false;

        $requete = "SELECT id_usager, mot_passe FROM vino__usager WHERE courriel = '$courriel'";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                $rows = $res->fetch_assoc();

                if (password_verify($password, $rows['mot_passe']))
                    $match = $rows['id_usager'];
            } else {
                $match = false;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $match;
    }
    
    /**
     * Retourne toutes les informations d'un usager.
     *
     * @param Integer $id
     * 
     * @throws Exception Erreur de requête sur la base de données.
     * 
     * @return Array Infos usager.
     */
    public function getUsagerParId($id) {
        $rows = array();

        $requete = "SELECT * FROM vino__usager WHERE id_usager = '$id'";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }
    
    /**
     * Supprime un usager de la db.
     *
     * @param Integer $id Id de l'usager.
     * 
     * @return Boolean $res Succès de la requête.
     */
    public function deleteUsager($id) {
        $requete = "DELETE FROM vino__usager WHERE id_usager = $id";

        $res = $this->_db->query($requete);

        return $res;
    }
    
    /**
     * Ajoute un usager à la db.
     *
     * @param Object $data Body de la requête.
     * 
     * @return mixed $res Id de l'usager ou échec de la requête.
     */
    public function createUsager($data) {
        $requete = "INSERT INTO vino__usager(nom,prenom,mot_passe) VALUES (" .
            "'" . $data->nom . "'," .
            "'" . $data->prenom . "'," .
            "" . $data->mot_passe . ")";

        $res = $this->_db->query($requete);

        if ($res) return $this->_db->insert_id;
        
        return $res;
    }
}
