<?php

namespace App\Http\Controllers;

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
        if(!isset($request->millesime)) {
            $request->millesime = 0;
        }

        $request->validate([
            'nom' => 'required',
        ]);
      
       if(isset($request->bouteille_id)){
        $cellierBouteille = CellierBouteille::rechercheCellierBouteille(1, $request->bouteille_id, $request->millesime);
        
        if(isset($cellierBouteille[0])){
            return back()->withInput()->with('erreur', "Bouteille existe déjà");
        }else {
            if(isset($request->date_achat)){
                $request->date_achat = date('Y-m-d', strtotime($request->date_achat));
            }
            $cellierBouteille = new CellierBouteille;
            $cellierBouteille->fill($request->all());
            $cellierBouteille->cellier_id = 1;
            $cellierBouteille->save();
            
            return redirect("cellier")->with("nouvelleBouteille", "nouvelle bouteille ajoutée" );
        }
    }
        
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
