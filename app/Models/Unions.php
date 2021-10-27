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
                                ->select(
                                    "id",
                                    "nom",
                                    "description",
                                    "url_image",
                                    "url_achat",
                                    "url_infos",
                                    "format",
                                    "pays_id",
                                    "categories_id",
                                    DB::raw("null as users_id"));

        $toutesBouteilles = DB::table("bouteilles_personnalisees")
                ->select(
                    "id",
                    "nom",
                    "description",
                    "url_image",
                    "url_achat",
                    "url_infos",
                    "format",
                    "pays_id",
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
