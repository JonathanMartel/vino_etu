<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleResource;
use App\Models\Bouteille;
use App\Models\BouteilleAchetee;
use App\Models\Cellier;
use App\Models\CellierBouteilleAchetee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CellierBouteilleAcheteeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //

    }

    /**
     *
     * Modifier l'inventaire d'une bouteille dans un cellier.
     *
     * @param int|string $cellierBouteilleAcheteeId l'id du pivot où se trouve l'inventaire
     *
     */
    public function modifierInventaireBouteille(Request $request, int $cellierBouteilleAcheteeId) {
        $cellierBouteilleAchetee = CellierBouteilleAchetee::find($cellierBouteilleAcheteeId);

        $cellierBouteilleAchetee->inventaire = $request->inventaire;

        if (!$cellierBouteilleAchetee->save()) {
            return response()->json([
                "message" => "Erreur lors de la mise à jour de l'inventaire"
            ], 400);
        };

        return response()->json([
            "message" => "Modification réussie"
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $bouteilleAchetee = new BouteilleAchetee($request->post());

        return response($bouteilleAchetee);

        $bouteilleCellier = new CellierBouteilleAchetee();
        $bouteilleCellier->bouteilles_achetees_id = $bouteilleAchetee->id;
        $bouteilleCellier->celliers_id = $request->celliers_id;
        $bouteilleCellier->inventaire = $request->inventaire;
        $newBouteilleCellier = $bouteilleCellier->save();

        return response()->json([
            "message" => "ajout réussi !"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function show(CellierBouteilleAchetee $cellierBouteilleAchetee) {
        return new BouteilleResource($cellierBouteilleAchetee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellier $cellier, Bouteille $bouteille) {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(CellierBouteilleAchetee $cellierBouteilleAchetee) {
        //
    }
}
