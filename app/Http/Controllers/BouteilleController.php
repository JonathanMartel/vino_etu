<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Format;


class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('bouteille.index', []);
    }


     /**
     * Mettre à jour la table Bouteille en important une liste de bouteille du site de la SAQ
     * @return response une liste de bouteilles qui n'était pas dans la BD
     */
	public function obtenirListeSAQ() {
        $nouvellesBouteilles = Bouteille::obtenirListeSAQ();
       
        return response()->json($nouvellesBouteilles);
    }

     /**
     * @param motCle
     * Rechercher dans la table bouteilles les noms qui contiennent le motCle
     * @return response une listes de bouteilles qui contiennent le motCle dans leur nom
     */
    public function rechercheBouteillesParMotCle($motCle) {
        $listeBouteilles = Bouteille::rechercheBouteillesParMotCle($motCle);

        return response()->json($listeBouteilles);
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
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function show(Bouteille $bouteille)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(Bouteille $bouteille)
    {
        $types = Type::all();
        $formats = Format::all();
        /* var_dump($bouteille->format); */
        return view('bouteille.edit', [
                                        'bouteille'=> $bouteille,
                                        'types' => $types,
                                        'formats' => $formats,
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bouteille $bouteille)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille)
    {
        //
    }
}
