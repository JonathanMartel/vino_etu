<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CellierController extends Controller
{

    /**
     * Show
     */
    public function index(Request $request)
    {
       
       Auth::check();
       $id_usager = Auth::id();
       $celliers = Cellier::where('id_usager', $id_usager)->get();
      
        return view('cellier.index', [
            'celliers' => $celliers
           
        ]);
    }


    /*
     Retourne la vue pour ajouter un cellier
    */
    public function nouveau(Request $request)
    {

       Auth::check();
       $id_usager = Auth::id();
       
        //Liste des cellier au besoins ... 
        // TODO selon le id de l'usager pas encore implementer
         $celliers = DB::table('vino__cellier')->where('id_usager', $id_usager)
         ->get();

        //vue creation ceillier 
        return view('cellier.nouveau', [
            'celliers' => $celliers
        ]);
    }

    /*
     Création d'un ceillier dansla BD
    */
    public function creer(Request $request)
    {
        $this->validateCellier($request);

        // On assume que la requête
        $cellier = Cellier::create($request->all());

    
        //Redirect avec message de succès
        return redirect()
        ->route('cellier.nouveau')
        ->withSuccess('Vous avez créé le cellier '.$cellier->nom_cellier.'!');
    }


    /**
     * Edit
    */
    public function edit(Request $request, $id)
    {
      
        //dd($id);
        $cellier = Cellier::findOrFail($id);
       
        return view('cellier.edit', [
            'cellier' => $cellier,
        ]);
    }



     /**
     * Update
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validateCellier($request);

        // On assume que la requête
        $cellier = Cellier::findOrFail($id)->update($request->all());


        // Retourne au formulaire
        return redirect()
            ->route('cellier.index')
            ->withSuccess('La modification a réussi!');
    }


    /**
     * Supprime
     */
    public function supprime(Request $request, $id)
    {
        //dd($id);
        $cellier = Cellier::findOrFail($id);
        $cellier->delete();
        
        return "Vous avez supprimer le cellier {$cellier->name} !";

    }


    /**
     * Fonction qui permet de valider les données de l'usager
     */
    private function validateCellier(Request $request)
    {
        $request->validate([
            'nom_cellier' => 'required'
        ]);
    }


}
