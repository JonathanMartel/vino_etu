<?php

/**
 * Gère les requêtes de celliers.
 */
class Cellier extends Modele
{
    /**
     * Ajoute un nouveau cellier.
     *
     * @param mixed $data Le body de la requête.
     * @return void
     */
    public function ajouterNouveauCellier($data)
    {
        //TODO : Valider les données.

        $requete = "INSERT INTO vino__cellier(emplacement_cellier,usager_id) VALUES (" .
            "'" . $data->emplacement_cellier . "'," .
            "" . $data->usager_id . ")";

        $res = $this->_db->query($requete);

        return $res;
    }
    
    /**
     * Retourne tous les celliers d'un usager.
     *
     * @param mixed $id L'id de l'usager.
     * @return void
     */
    public function getCelliersParUsagerId($id)
    {
        $rows = array();

        $requete = "SELECT id_cellier, emplacement_cellier FROM vino__cellier WHERE usager_id = $id";

        if (($res = $this->_db->query($requete)) ==     true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['emplacement_cellier'] = trim(utf8_encode($row['emplacement_cellier']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
            //$this->_db->error;
        }

        return $rows;
    }
}
