<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleAcheteeResource;
use App\Models\BouteilleAchetee;
use Illuminate\Http\Request;

class BouteilleAcheteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BouteilleAchetee  $bouteilleAchetee
     * @return \Illuminate\Http\Response
     */
    public function show(BouteilleAchetee $bouteilleAchetee)
    {
        return BouteilleAcheteeResource::make($bouteilleAchetee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BouteilleAchetee  $bouteilleAchetee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BouteilleAchetee $bouteilleAchetee)
    {
        $bouteilleAchetee->nom                = $request->nom;
        $bouteilleAchetee->description        = $request->description;
        $bouteilleAchetee->url_image          = $request->url_image;
        $bouteilleAchetee->url_info           = $request->url_info;
        $bouteilleAchetee->url_achat          = $request->url_achat;
        $bouteilleAchetee->millesime          = $request->millesime;
        $bouteilleAchetee->format             = $request->format;
        $bouteilleAchetee->notes_personnelles = $request->notes_personnelles;
        $bouteilleAchetee->prix_paye          = $request->prix_paye;
        $bouteilleAchetee->conservation       = $request->conservation;

        if(!$bouteilleAchetee->save()) {
            return response()->json([
                "message" => "Erreur lors de la mise à jour"
            ], 501);
        }

        return response()->json([
           "message"  => "Mise à jour réussie"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BouteilleAchetee  $bouteilleAchetee
     * @return \Illuminate\Http\Response
     */
    public function destroy(BouteilleAchetee $bouteilleAchetee)
    {
        //
    }

    public function modifierBouteilleAchetee(Request $request, int $BouteilleAcheteeId) {
        $bouteilleAchetee = BouteilleAchetee::find($BouteilleAcheteeId);

        $bouteilleAchetee->nom = $request->nom;
        $bouteilleAchetee->description = $request->description;
        $bouteilleAchetee->format = $request->format;
        $bouteilleAchetee->origine = $request->origine;
        $bouteilleAchetee->url_achat = $request->url_achat;
        $bouteilleAchetee->millesime = $request->millesime;
        $bouteilleAchetee->date_acquisition = $request->date_acquisition;
        $bouteilleAchetee->prix_paye = $request->prix_paye;
        $bouteilleAchetee->conservation = $request->conservation;
        $bouteilleAchetee->note_personnelles = $request->note_personnelles;


        if (!$bouteilleAchetee->save()) {
            return response()->json([
                "message" => "Erreur lors de la mise à jour des informations de la bouteille"
            ], 400);
        };

        return response()->json([
            "message" => "Modification réussie"
        ], 201);
    }
}
