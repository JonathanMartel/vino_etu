<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 *
 * Classe servant à obtenir le résultat de diverses unions nécessaires à des requêtes
 *
 */
class Unions {
    static public function obtenirCatalogueBouteillesPourUtilisateur(int $idUtilisateur = 1, int $limite = 24) {
        $requeteBouteille = DB::table("bouteilles")
                                ->join("pays", "pays.id", "=","bouteilles.pays_id")
                                ->join("categories", "categories.id", "=", "bouteilles.categories_id")
                                ->select(
                                    "bouteilles.id",
                                    "bouteilles.nom",
                                    "description",
                                    "url_image",
                                    "format",
                                    "pays.nom as pays",
                                    "categories.nom as categorie",
                                    DB::raw("null as users_id"));

        $toutesBouteilles = DB::table("bouteilles_personnalisees as bp")
                                        ->join("pays", "pays.id", "=","bp.pays_id")
                                        ->join("categories", "categories.id", "=", "bp.categories_id")
                                        ->select(
                                            "bp.id",
                                            "bp.nom",
                                            "description",
                                            "url_image",
                                            "format",
                                            "pays.nom as pays",
                                            "categories.nom as categorie",
                                            "users_id")
                                        ->where("users_id", $idUtilisateur)
                                        ->unionAll($requeteBouteille)
                                        ->orderBy("nom")
                                        // ->get();
                                        // ->toSql();
                                        ->paginate($limite);

        // dd($toutesBouteilles);
        /* $tousNomsBouteilles = $toutesBouteilles->map(function($item) {
            return $item->nom;
        }); */

        return $toutesBouteilles;
    }
}
