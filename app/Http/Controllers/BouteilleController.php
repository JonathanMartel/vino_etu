<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\BouteillePersonalize;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
//use Illuminate\Http\Request;



class BouteilleController extends Controller
{
    //
    public function index()
    {
        return view('bouteille.liste', [
            'data' => Bouteille::get(),
            'msg'=> NULL
        ]);
    }

    /*
     Retourne la vue pour ajouter une bouteille
    */
    public function nouveau(Request $request)
    {
        //dd('nouvelleBouteille');
       
        //Liste des bouteille au besoins ... 
        // TODO selon le id de l'usager pas encore implementer
         $bouteilles = DB::table('vino__bouteille')
         ->get();

       

        //vue ajout d'une bouteille 
        return view('bouteille.nouveau', [
            'bouteilles' => $bouteilles
           
        ]);
    }

    /*
     Création d'une bouteille dans la BD
    */
    public function creer(Request $request)
    {
        //$this->validateBouteille($request);

        // On assume que la requête
        $bouteille = BouteillePersonalize::create(Request::all());


        //--------TODO 

        /*ajout bouteille/ceillier
        /* model=CelliersBouteilles 

        --------------*/

        //dd($bouteille);
    
        //Redirect avec message de succès
        return redirect()
        ->route('bouteille.nouveau')
        ->withSuccess('Vous avez créé le bouteille '.$bouteille->nom.'!');
    }

    public function recherche(Request $request)
    {
            
            $data = '';
            $recherche = Request::get('recherche');

         //Requete sur la recherche , limit de 10
            if($recherche != '')
            {
                $data = DB::table('vino__bouteille')
                ->where('nom','like','%' .$recherche. '%')
                ->take(10)
                ->get();
            }

            return json_encode($data);
    }


    /**
     * Edit bouteille
    */
    public function edit(Request $request, $id)
    {
      
        // TODO lier usager à ses bouteille...
        //$bouteille = BouteillePersonalize::findOrFail($id);
        $bouteille = Bouteille::findOrFail($id);

       
       
        return view('bouteille.edit', [
            'bouteille' => $bouteille
        ]);
    }


     /**
     * Update
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $this->validateBouteille($request);

        
        // TODO lier usager à ses bouteille...
        //$bouteille = BouteillePersonalize::findOrFail($id)->update(Request::all());
        $bouteille = Bouteille::findOrFail($id)->update(Request::all());
        


        // Retourne a la liste du cellier --TODO
        return redirect()
            ->route('bouteille.edit')
            ->withSuccess('La modification a réussi!');
    }


    /**
     * Supprime
     */
    public function supprime(Request $request, $id)
    {
        //dd($id);
        // TODO lier usager à ses bouteille...
        //$bouteille = BouteillePersonalize::findOrFail($id);
        $bouteille = Bouteille::findOrFail($id);
        $bouteille->delete();

        //--------TODO 

        /*supprimer bouteille/ceillier
        /* model=CelliersBouteilles 

        --------------*/

        
        return "Vous avez supprimer le cellier {$bouteille->nom} !";

    }


    /**
     * Fonction qui permet de valider les données de l'usager 
     */
    private function validateBouteille(Request $request)
    {
        Request::validate([
            'nom' => 'required',
            'type' => 'required'
        ]);
    }
    
}
