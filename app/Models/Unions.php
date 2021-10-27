<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 *
 * Classe servant à obtenir le résultat de diverses unions nécessaires à des requêtes
 *
 */
class Unions {
    static public function obtenirCatalogueBouteillesParUtilisateur(int $idUtilisateur = 1, int $limite = 24) {
        $requeteBouteille = DB::table("bouteilles")
                                // ->leftJoin("pays", "pays.id", "=","bouteilles.pays_id")
                                ->select(
                                    "bouteilles.id",
                                    "bouteilles.nom",
                                    "description",
                                    "url_image",
                                    "format",
                                    // DB::raw("pays.nom as pays"),
                                    "categories_id",
                                    DB::raw("null as users_id"));

        $toutesBouteilles = DB::table("bouteilles_personnalisees as bp")
                                        // ->leftJoin("pays", "pays.id", "=","bp.pays_id")
                                        ->select(
                                            "bp.id",
                                            "bp.nom",
                                            "description",
                                            "url_image",
                                            "format",
                                            // "pays.nom as pays",
                                            "categories_id",
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
