<?php

namespace App\Http\Controllers;

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
        $cellier = CellierBouteille::all();

var_dump($cellier);

	    return view('cellier.index', [
            'cellier' => $cellier,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function ajouterBouteille($idCellier, $idBouteille)
    {
        $bouteilleCellier = CellierBouteille::selectCellierBouteille($idCellier, $idBouteille);

var_dump($bouteilleCellier);


         $bouteilleCellier->update([
             'quantite' => $bouteilleCellier->quantite + 1,
         ]);

         return redirect('cellier');
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
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function show(CellierBouteille $cellierBouteille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(CellierBouteille $cellierBouteille)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CellierBouteille $cellierBouteille)
    {
        //
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

    public function boireBouteille($idCellier)
    {
        $bouteilleCellier = CellierBouteille::find($idCellier);

         $bouteilleCellier->update([
             'quantite' => $bouteilleCellier->quantite - 1,
         ]);

         return redirect('cellier');
    }

}
