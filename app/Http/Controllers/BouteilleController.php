<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleResource;
use App\Models\Bouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BouteilleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->limite = 24;

        $orderBy = $request->orderBy = "b.nom";
        $orderDirection = $request->orderDirection = "asc";
        // $request->texteRecherche = "";

        /* return BouteilleResource::collection(
            Bouteille::orderBy($request->orderBy, $request->orderDirection)
                     ->paginate($request->limite)); */

        $requete = DB::table("bouteilles as b")
                        ->join("pays as p", "p.id", "=", "b.pays_id")
                        ->join("categories as c", "c.id", "=", "b.categories_id")
                        ->select("*", "p.nom as pays", "c.nom as categorie", "b.nom as nom", "b.id as id");

        if($request->texteRecherche && strlen($request->texteRecherche) >= 3) {
            $recherche = $request->texteRecherche;

            $requete = $requete
                            ->whereRaw("MATCH(b.nom,description,b.format) against (? in boolean mode)", ["*$recherche*"])
                            ->orWhereRaw("MATCH(p.nom) against (? in boolean mode)", ["*$recherche*"])
                            ->orWhereRaw("MATCH(c.nom) against (? in boolean mode)", ["*$recherche*"]);
        }



        return $requete
                        ->orderBy($orderBy, $orderDirection)
                        ->paginate($request->limite);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */

    public function show(Bouteille $bouteille) {

        return BouteilleResource::make($bouteille);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bouteille $bouteille) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille) {
        //
    }
}
