<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;

use Illuminate\Support\Facades\DB;

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
     Création d'un ceillier dansla BD
    */
    public function creer(Request $request)
    {
        $this->validatebouteille($request);

        // On assume que la requête
        $bouteille = bouteille::create($request->all());

    
        //Redirect avec message de succès
        return redirect()
        ->route('bouteille.nouveau')
        ->withSuccess('Vous avez créé le bouteille '.$bouteille->nom_bouteille.'!');
    }

    public function recherche(Request $request)
    {
            //dd('recherche');
            $data = '';
           // $recherche = $request->get('recherche');
            $recherche = $request->input('recherche');
            if($recherche != '')
            {
                $data = DB::table('vino__bouteille')
                ->where('nom','like','%' .$recherche. '%')
                ->get();
            }
            // else
            // if you want to show all the data
            // {
            //     $data = DB::table('categories')
            //     ->orderBy('title','asc')
            //     ->get();
            // }

           /* if ($request->ajax()) {
                return response()->json($data);
            }*/
        
            /*return view('bouteille.nouveau', [
               'data' => $data
            ]);*/
            dd($data);
            return json_encode($data);
    }

        
       /* $bte = new Bouteille();
        $body = json_decode(file_get_contents('php://input'));
        $listeBouteille = $bte->autocomplete($body->nom);
        echo json_encode($listeBouteille);  */      
    
}
