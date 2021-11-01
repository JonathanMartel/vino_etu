<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cellier extends Model
{
    use HasFactory;

    public function bouteilles() {
        return $this->belongsToMany(Bouteille::class, "celliers_bouteilles", "celliers_id", "bouteilles_id")->withPivot(["inventaire"]);
    }

    /**
     *
     * Récupérer les bouteilles contenu dans un cellier donné.
     *
     * @param int|string $cellierId l'id du cellier d'on on veut afficher l'inventaire
     */
    static public function obtenirBouteillesParCellier(int $cellierId, int $limite = 24, array $filtres = null) {
        return
            DB::table('celliers_bouteilles_achetees as cba')
                ->join("bouteilles_achetees as ba", "cba.bouteilles_achetees_id", "=", "ba.id")
                ->join("categories as cat", "ba.categories_id", "=", "cat.id")
                ->select(
                    "cba.id as inventaireId",
                    "cba.inventaire as inventaire",
                    "ba.url_image as imageBouteille",
                    "ba.nom as nom",
                    "ba.url_image as image",
                    "ba.format as format",
                    "pays.nom as pays",
                    "cat.nom as categorie")
                ->where("cba.celliers_id", $cellierId)
                ->paginate($limite);
    }
}
