<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 *
 * Classe servant à obtenir le résultat de diverses unions nécessaires à des requêtes
 *
 */
class Unions {
    static public function obtenirCatalogueBouteillesParUtilisateur(int $idUtilisateur = 1, int $limite = 48) {
        $requeteBouteille = DB::table("bouteilles")
                                ->select("*", DB::raw("NULL as users_id"));

        $toutesBouteilles = DB::table("bouteilles_personnalisees")
                ->select("*")
                ->where("users_id", $idUtilisateur)
                ->unionAll($requeteBouteille)
                ->orderBy("nom")
                ->limit($limite)
                ->get();

        // dd($toutesBouteilles);
        /* $tousNomsBouteilles = $toutesBouteilles->map(function($item) {
            return $item->nom;
        }); */

        return $toutesBouteilles->toJson();
    }
}
