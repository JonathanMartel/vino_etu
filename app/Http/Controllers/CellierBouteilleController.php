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
        $cellierBouteilles = CellierBouteille::all();

	    return view('cellierBouteille.index', [
            'cellierBouteilles' => $cellierBouteilles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cellierBouteille.create', [
            
        ]);
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
     * https://stackoverflow.com/questions/37666135/how-to-increment-and-update-column-in-one-eloquent-query
     * Incrémenter de 1 la quantité de la bouteille dans un cellier
     * @return la quantité à incrémenter
     */
    public function ajouterBouteille($idCellier, $idBouteille, $millesime)
    {
        $quantiteAjoute = 1; // a inclure en paramettre si on donne l'option d'ajouter plus d'une bouteille à la fois.

        if($millesime == 0) {
            $millesime = 0000;
        }
        $estAjoute = CellierBouteille::modifierQuantiteBouteille($idCellier, $idBouteille, $millesime, $quantiteAjoute);

        if($estAjoute){
            return response()->json($quantiteAjoute);
        }
    }

     /**
     *
     * Décrémenter de 1 la quantité de la bouteille dans un cellier
     */
    public function boireBouteille($idCellier, $idBouteille, $millesime)
    {
        $quantiteBue = -1; // a inclure en paramettre si on donne l'option d'ajouter plus d'une bouteille à la fois.


        if($millesime == 0) {
            $millesime = 0000;
        }
        $estBue = CellierBouteille::modifierQuantiteBouteille($idCellier, $idBouteille, $millesime, $quantiteBue);

        if($estBue){
            return response()->json($quantiteBue);
        }
         return redirect('cellier');
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

    

}
