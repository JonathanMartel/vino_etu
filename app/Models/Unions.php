<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 *
 * Classe servant à obtenir le résultat de diverses unions nécessaires à des requêtes
 *
 */
class Unions {
    static public function obtenirSuggestionsNomsDeBouteilles() {
        $requeteBouteille = DB::table("bouteilles")
                                ->select("nom");

        $toutesBouteilles = DB::table("bouteilles_personnalisees")
                ->select("nom")
                ->where("users_id", 1)
                ->union($requeteBouteille)
                ->orderBy("nom")
                ->get();

        $tousNomsBouteilles = $toutesBouteilles->map(function($item) {
            return $item->nom;
        });

        return $tousNomsBouteilles->toJson();
    }
}
