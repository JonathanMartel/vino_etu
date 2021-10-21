<?php

namespace App\Http\Controllers;

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
     * https://stackoverflow.com/questions/37666135/how-to-increment-and-update-column-in-one-eloquent-query
     * Incrémenter de 1 la quantité de la bouteille dans un cellier
     * @return la quantité à incrémenter
     */
    public function ajouterBouteille($idCellier, $idBouteille, $millesime)
    {   
        $quantiteAjoutee = 1;

        if($millesime == 0) {
            $millesime = 0000;
        }
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->increment('quantite', $quantiteAjoutee);
        

         return response()->json($quantiteAjoutee);
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

     /**
     * 
     * Décrémenter de 1 la quantité de la bouteille dans un cellier
     */
    public function boireBouteille($idCellier, $idBouteille, $millesime)
    {
        if($millesime == 0) {
            $millesime = 0000;
        } 
        DB::table('cellier_bouteilles')
        ->where('cellier_id', $idCellier)
        ->where('bouteille_id', $idBouteille)
        ->where('millesime', $millesime)
        ->decrement('quantite', 1);
        
         return redirect('cellier');
    }

}
