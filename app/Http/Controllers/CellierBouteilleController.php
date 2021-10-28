<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleResource;
use App\Models\Bouteille;
use App\Models\Cellier;
use App\Models\CellierBouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CellierBouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     *
     * Afficher les bouteilles contenu dans un cellier donné
     *
     *
     */
    public function obtenirBouteillesParCellier(Cellier $cellier) {
        return
            DB::table('celliers_bouteilles as cb')
                ->join("bouteilles as b", "bouteilles_id", "=", "b.id")
                ->join("pays", "b.pays_id", "=", "pays.id")
                ->join("categories as cat", "b.categories_id", "=", "cat.id")
                ->select(
                    "cb.inventaire as inventaire",
                    "b.nom as nom",
                    "pays.nom as pays",
                    "cat.nom as categorie")
                ->where("cb.celliers_id", $cellier->id)
                ->paginate(24);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Cellier $cellier, Request $request)
    {

        $bouteilleCellier = new CellierBouteille;
        $bouteilleCellier -> bouteilles_id = $request->bouteilles_id;
        $bouteilleCellier -> celliers_id = $request->celliers_id;
        $bouteilleCellier -> inventaire = $request->inventaire;
        $newBouteilleCellier = $bouteilleCellier -> save();

        return response("Ça marche, $newBouteilleCellier !", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function show(CellierBouteille $cellierBouteille)
    {
        return new BouteilleResource($cellierBouteille);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellier $cellier, Bouteille $bouteille)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(CellierBouteille $cellierBouteille)
    {
        //
    }
}
