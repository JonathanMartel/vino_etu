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

        if ($res) return $this->_db->insert_id;

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

        $requete = "SELECT vino__cellier.*, SUM(vino__cellier_inventaire.quantite) AS quantite FROM vino__cellier"
        . " LEFT JOIN vino__cellier_inventaire ON vino__cellier.id_cellier = vino__cellier_inventaire.id_cellier"
        . " WHERE vino__cellier.usager_id = 3"
        . " GROUP BY vino__cellier.emplacement"
        . " ORDER BY vino__cellier.id_cellier";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $row['emplacement'] = trim(utf8_encode($row['emplacement']));
                    $rows[] = $row;
                }
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }

    /**
     * Retourne le cellier avec ses bouteilles.
     *
     * @param mixed $id L'id du cellier.
     * 
     * @throws Exception Erreur de requête sur la base de données.
     * 
     * @return Array $rows Résultats de la requête.
     */
    public function getCellierParIdAvecBouteilles($id)
    {
        $rows = array();

        $requete = "SELECT vino__bouteille.*, vino__cellier.id_cellier, vino__cellier.emplacement, .vino__cellier_inventaire.quantite FROM vino__cellier"
            . " LEFT JOIN vino__cellier_inventaire ON vino__cellier.id_cellier = vino__cellier_inventaire.id_cellier"
            . " LEFT JOIN vino__bouteille ON vino__cellier_inventaire.bouteille_id = vino__bouteille.id"
            . " WHERE vino__cellier.id_cellier = $id";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            } else {
                $rows = false;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }

    /**
     * Retourne le cellier.
     *
     * @param mixed $id L'id du cellier.
     * 
     * @throws Exception Erreur de requête sur la base de données.
     * 
     * @return Array $rows Résultats de la requête.
     */
    public function getCellierParId($id)
    {
        $rows = array();

        $requete = "SELECT * FROM vino__cellier WHERE id_cellier = $id";

        if (($res = $this->_db->query($requete)) == true) {
            if ($res->num_rows) {
                while ($row = $res->fetch_assoc()) {
                    $rows[] = $row;
                }
            } else {
                $rows = false;
            }
        } else {
            throw new Exception("Erreur de requête sur la base de donnée", 1);
        }

        return $rows;
    }
    
    /**
     * Delete un cellier de la db.
     *
     * @param Integer $id Id du cellier.
     * 
     * @return Boolean $res Succès de la requête.
     */
    public function deleteCellier($id)
    {
        $requete = "DELETE FROM vino__celier WHERE id_cellier = $id";

        $res = $this->_db->query($requete);

        return $res;
    }

    /**
     * Modifie les infos d'un cellier dans la db.
     *
     * @param Object $body Nouvelles infos de cellier.
     * 
     * @return Boolean $res Succès de la requête.
     */
    public function modifierCellier($body)
    {
        $requete = "UPDATE vino__cellier SET emplacement = '$body->emplacement', temperature = '$body->temperature' WHERE id_cellier = $body->id";

        $res = $this->_db->query($requete);

        return $res;
    }
}
