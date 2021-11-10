<?php

namespace VinoAPI\Modeles;

use Exception;

/**
 * Gère les requêtes des listes d'achats.
 */
class ListeAchatModele extends Modele
{
    /**
     * Get la liste d'achat d'un usager.
     *
     * @param Integer $id Id de l'usager.
     * 
     * @return Boolean $res Succès de la requête.
     */
    public function getListeAchatParIdUsager($id)
    {
        $rows = array();

        $requete = "SELECT a.id, b.item, c.nom, b.millesime, b.quantite FROM vino__liste_achat a, vino__liste_achat_vino b, vino__bouteille c"
            . " WHERE a.id_usager = $id AND a.id = b.liste_achat_id AND b.bouteille_id = c.id";

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
}
