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
    static public function obtenirBouteillesParCellier(
        int $cellierId,
        int $limite = 24,
        $orderBy = "nom",
        $orderDirection = "asc",
        array $filtres = null
    ) {
        // Mapping afin de s'assurer que l'utilisateur envoie bel et bien une valeur existante
        $orderByMapping = [
            "nom"     => "ba.nom",
            "origine" => "ba.origine"
        ];

        // Par défaut, mettre le nom comme champ de tri...
        $orderByTri = $orderByMapping["nom"];

        // ...si l'argument reçu existe dans le mapping, écraser la valeur par défaut
        if(array_key_exists($orderBy, $orderByMapping)) {
            $orderByTri = $orderByMapping[$orderBy];
        }

        $requete = DB::table('celliers_bouteilles_achetees as cba')
                        ->join("bouteilles_achetees as ba", "cba.bouteilles_achetees_id", "=", "ba.id")
                        ->join("categories as cat", "ba.categories_id", "=", "cat.id")
                        ->select(
                            "cba.id as inventaireId",
                            "cba.inventaire as inventaire",
                            "ba.id as bouteilleId",
                            "ba.nom as nom",
                            "ba.description as description",
                            "ba.url_image",
                            "ba.url_achat",
                            "ba.url_info",
                            "ba.format",
                            "ba.origine",
                            "ba.millesime",
                            "ba.prix_paye",
                            "ba.date_acquisition",
                            "ba.conservation",
                            "ba.notes_personnelles",
                            "cat.nom as categorie")
                        ->where("cba.celliers_id", $cellierId);

        if($texteRecherche = $filtres["texteRecherche"]) {
            self::annexerRechercheTextuelle($requete, $texteRecherche);
        }

        return $requete->orderBy($orderByTri, $orderDirection)
                       ->paginate($limite);
    }

    /**
     *
     * Annexe la recherche textuelle à la requête SQL de la liste de bouteilles d'un cellier.
     *
     * @param Builder $requete requête passée en référence afin de la métamorphoser
     *
     */
    static private function annexerRechercheTextuelle(&$requete, $recherche) {
        $requete->whereRaw("MATCH(ba.nom, ba.description, ba.format, ba.origine, ba.notes_personnelles, ba.conservation) against (? in natural language mode)", ["*$recherche*"])
                ->orWhereRaw("MATCH(cat.nom) against (? in natural language mode)", ["*$recherche*"]);
    }
}
