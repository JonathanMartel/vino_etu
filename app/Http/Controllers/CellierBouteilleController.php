<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleResource;
use App\Models\Bouteille;
use App\Models\Cellier;
use App\Models\CellierBouteille;
use Illuminate\Http\Request;

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
        return BouteilleResource::make($cellier->bouteilles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
<<<<<<< HEAD
    public function store(Request $request, Cellier $cellier)
    {
        $bouteilleCellier = new CellierBouteille;
        $bouteilleCellier -> bouteilles_id = $request->bouteilles_id;
        $bouteilleCellier -> celliers_id = $request->celliers_id;
        $bouteilleCellier -> inventaire = $request->inventaire;
        $newBouteilleCellier = $bouteilleCellier -> save();
        
        return response("Ca marche, $newBouteilleCellier !", 200);
=======
    public function store(Cellier $cellier, Request $request)
    {

        return response("Ça marche, $cellier->id !", 200);
>>>>>>> a34c05718af0d7920eee8ca7b3c2e135f10afe51
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

    /**
     *
     * Afficher les bouteilles contenu dans un cellier donné
     *
     */
    public function obtenirBouteillesParCellier(Cellier $cellier) {
        return BouteilleResource::collection($cellier->bouteilles());
    }

}
