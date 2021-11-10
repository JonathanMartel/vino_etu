<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use App\Models\CellierBouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {

            $userCelliers = Cellier::getCelliersByUser(Auth::user()->id);
                        
            if (Auth::user()->id <> 1 && !isset($userCelliers[0])){
                return view('celliers.create');
            }

            return view('celliers.index', ['celliers' => $userCelliers]);
        }

        return redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('celliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required | max:32',
            'localisation' => 'required | max:40',
            'user_id' => 'required | exists:users,id',
        ]);

        $post = Cellier::create($request->all());
        return redirect('cellier/' . $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function show(Cellier $cellier)
    {
        return CellierBouteilleController::index($cellier->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function edit(Cellier $cellier)
    {
        return view('celliers.edit', ['cellier' => $cellier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellier $cellier)
    {
        $request->validate([
            'nom' => 'required | max:32',
            'localisation' => 'required | max:40',
        ]);

        $cellier->update([
            'nom' => $request->nom,
            'localisation' => $request->localisation,
        ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier $cellier)
    {
        $cellier->delete();

        return redirect('/');
    }

    public function rechercheDansCellier($motCle, $idCellier) {
        $bouteilles = Cellier::rechercheDansCellier($motCle, $idCellier);

        return response()->json($bouteilles);
    }

    public function reinitialiserCellier($idCellier) {
        $bouteilles = CellierBouteille::obtenirListeBouteilleCellier($idCellier);

        return response()->json($bouteilles);
    }
}
