<?php

namespace VinoAPI\Modeles;

use Exception;

/**
 * Traite les requêtes des celliers à la db.
 */
class CellierModele extends Modele
{
    /**
     * Ajoute un nouveau cellier.
     *
     * @param mixed $data Le body de la requête.
     * 
     * @return Boolean Passage de la requête.
     */
    public function ajouterNouveauCellier($data)
    {
        //TODO : Valider les données.

        $requete = "INSERT INTO vino__cellier(emplacement,usager_id) VALUES (" .
            "'" . $data->emplacement . "'," .
            "" . $data->usager_id . ")";

        $res = $this->_db->query($requete);

        return $res;
    }

    /**
     * Retourne tous les celliers d'un usager.
     *
     * @param mixed $id L'id de l'usager.
     * 
     * @return Array Résultats de la requête.
     */
    public function getCelliersParUsagerId($id)
    {
        $rows = array();

        $requete = "SELECT id_cellier, emplacement FROM vino__cellier WHERE usager_id = $id";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['emplacement_cellier'] = trim(utf8_encode($row['emplacement']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }
}
