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
    static public function obtenirBouteillesParCellier(int|string $cellierId, int $limite = 24, array $filtres = null) {
        return
            DB::table('celliers_bouteilles as cb')
                ->join("bouteilles as b", "bouteilles_id", "=", "b.id")
                ->join("pays", "b.pays_id", "=", "pays.id")
                ->join("categories as cat", "b.categories_id", "=", "cat.id")
                ->select(
                    "cb.id as inventaireId",
                    "cb.inventaire as inventaire",
                    "b.url_image as imageBouteille",
                    "b.nom as nom",
                    "b.url_image as image",
                    "b.format as format",
                    "pays.nom as pays",
                    "cat.nom as categorie")
                ->where("cb.celliers_id", $cellierId)
                ->paginate($limite);
    }
}
