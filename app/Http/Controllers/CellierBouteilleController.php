<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Type;
use App\Models\CellierBouteille;
use App\Models\Format;
use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Share;

class CellierBouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($idCellier)
    {
        $cellier = Cellier::find($idCellier);
        $celliers = Cellier::getCelliersByUser(session('user')->id);
        $cellierBouteillesIDs = CellierBouteille::getCellierBouteillesIDs($idCellier);

        foreach ($cellierBouteillesIDs as $bouteilleID) {

            $bouteille = Bouteille::getDataBouteilleByID($bouteilleID->bouteille_id); //infos générales de la bouteille obtenue grace a son ID
            $dataCellierBouteillesByIDs = CellierBouteille::getDataCellierBouteillesByID($idCellier, $bouteilleID->bouteille_id);

            $cellierBouteillesByIDs[$bouteilleID->bouteille_id] = [
                "bouteille" => $bouteille[0],
                "id" => $bouteilleID->bouteille_id,
                "dataCellier" => $dataCellierBouteillesByIDs,
            ];

        }

        return view('cellierBouteille.index', [
            'cellier' => $cellier,
          'cellierBouteillesByIDs' => $cellierBouteillesByIDs ?? [],
            'celliers' => $celliers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idCellier)
    {
        $types = Type::all();
        $formats = Format::all();
        return view('cellierBouteille.create', [
            'types' => $types,
            'formats' => $formats,
            'idCellier' => $idCellier
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

/* Creation de la bouteille */



        $date_achat = null;

        if (isset($request->date_achat)) {
            $date_achat = date('Y-m-d', strtotime($request->date_achat));
        }

        $millesime = 0;

        if (!empty($request->millesime)) {
            $millesime = $request->millesime;
        }

        $request->validate([
            'quantite' => 'integer|gte:0',
            'prix' => 'numeric|regex:/[0-9]+(\.[0-9][0-9]?)?/|gte:0|max:100000',
          
        ]);

        /**
         * Vérifier si la bouteille existe dans la table cellier_bouteilles et le vin dans la table bouteilles
         * Si oui indique qu'elle existe déjà
         * Sinon si elle n'existe pas dans table bouteille, la créer et ajouter dans la table cellier_bouteille
         * Si la bouteille existe dans la table bouteillesm l'ajouter dans la table cellier_bouteilles
         */
        $bouteilleExistante = Bouteille::rechercheBouteilleExistante($request);
            
            if (isset($bouteilleExistante[0])) {
                $cellierBouteille = CellierBouteille::rechercheCellierBouteille($request->cellier_id, $bouteilleExistante[0]->id, $millesime);
                
                if(isset($cellierBouteille[0])){
                    return back()->withInput()->with('erreur', "Bouteille existe déjà");
                }else {
                    self::creerCellierBouteille ($request, $bouteilleExistante[0]->id, $date_achat, $millesime);
                    return redirect("cellier/" . $request->cellier_id)->withInput()->with("nouvelleBouteille", "nouvelle bouteille ajoutée");
                }
            }else {
                $bouteille = BouteilleController::store($request);
            
                self::creerCellierBouteille ($request, $bouteille->id, $date_achat, $millesime);
        
                return redirect("cellier/" . $request->cellier_id)->withInput()->with("nouvelleBouteille", "nouvelle bouteille ajoutée");
            }
        
    }

    public static function creerCellierBouteille ($request, $idBouteille, $date_achat, $millesime){
        $cellierBouteille = new CellierBouteille;
        $cellierBouteille->fill($request->all());
        $cellierBouteille->bouteille_id = $idBouteille;
        $cellierBouteille->date_achat = $date_achat;
        $cellierBouteille->millesime =  $millesime;
        $cellierBouteille->save();
    
    }




    /**
     * @param idCellier
     * @param idBouteille
     * Obtenir une liste des millisimes équivalent à idCellier et idBouteille
     * @return response une liste des millisime
     */
    public static function obtenirMillesimesParBouteille($idCellier, $idBouteille)
    {

        $millesimes = CellierBouteille::obtenirMillesimesParBouteille($idCellier, $idBouteille);
        return response()->json($millesimes);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function show($idCellier, $idBouteille)
    {
        session(['idCellier' => $idCellier]);
        
        $cellier = Cellier::find($idCellier);
        $bouteille = Bouteille::getDataBouteilleByID($idBouteille);
        $cellierBouteille = CellierBouteille::obtenirListeBouteilleCellier($idCellier);
        $cellierBouteilleMillesime = CellierBouteille::obtenirMillesimesParBouteille($idCellier, $idBouteille);
        $celliers = Cellier::getCelliersByUser(session('user')->id);
        $cellierBouteillesIDs = CellierBouteille::getCellierBouteillesIDs($idCellier);
        $bouteilles = [];
        foreach ($cellierBouteillesIDs as $bouteilleID) {

            $infoBouteille = Bouteille::getDataBouteilleByID($bouteilleID->bouteille_id); //infos générales de la bouteille obtenue grace a son ID
          
            $cellierBouteillesByIDs[$bouteilleID->bouteille_id] = [
                "bouteille" => $infoBouteille[0],
                "id" => $bouteilleID->bouteille_id,   
            ];

        }
        // print_r ($cellierBouteille);
        $shareComponent = Share::currentPage()
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();

        return view('cellierBouteille.show', compact('shareComponent'),[
            'bouteille' => $bouteille[0],
            'cellierBouteille' => $cellierBouteille[0],
            'cellier' => $cellier,
            'cellierBouteilleMillesime' =>  $cellierBouteilleMillesime,
            'celliers' => $celliers,
            'bouteilles' => $bouteilles,
            'cellierBouteillesByIDs' => $cellierBouteillesByIDs
        ]);
        
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function edit(CellierBouteille $cellierBouteille)
    {
        return view('cellierBouteille.edit', ['cellierBouteille' => $cellierBouteille]);
    }

    /**
     * @param idCellier
     * @param idBouteille
     * @param millesime
     * @param note
     * ajouter une note de dégustation à une bouteille
     */
    public function ajouterNote($idCellier, $idBouteille, $millesime, $note)
    {
        CellierBouteille::ajouterNote($idCellier, $idBouteille, $millesime, $note);
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

        if ($estAjoute) {
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

        if ($estBue) {
            return response()->json($quantiteBue);
        }
    }



    public function obtenirMillesime($idCellier, $idBouteille, $millesime)
    {
        

        $cellierBouteille = CellierBouteille::rechercheCellierBouteille($idCellier, $idBouteille, $millesime);

            return response()->json($cellierBouteille);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCellier, $idBouteille, $millesime)
    {   
        CellierBouteille::updateCellierBouteille($idCellier, $idBouteille, $millesime, $request);
        // $cellierBouteille->update([
        //     'millesime' => $request->millesime,
        //     'prix' => $request->prix,
        //     'quantite' => $request->quantite,
        //     'commentaire' => $request->commentaire,
        //     'garde_jusqua' => $request->garde_jusqua,
        //     'date_achat' => $request->date_achat,
        // ]);
         return redirect('/cellier/'.$idCellier."/".$idBouteille);

    }

    public function  modifierCellierBouteille($idCellier, $idBouteille, $millesime, $prix, $quantite, $date_achat, $commentaire=null, $garde_jusqua=null)
    {   
        CellierBouteille::modifierCellierBouteille($idCellier, $idBouteille, $millesime, $prix, $quantite, $date_achat, trim($commentaire), $garde_jusqua);


     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CellierBouteille  $cellierBouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCellier, $idBouteille, $millesime)
    {

        CellierBouteille::suprimerCellierBouteille($idCellier, $idBouteille, $millesime);
      
        if(isset(CellierBouteille::obtenirMillesimesParBouteille($idCellier, $idBouteille)[0])){
            $url = URL::to(''). '/cellier/'.$idCellier.'/'.$idBouteille;

        }else{

            $url = URL::to(''). '/cellier/'.$idCellier;
        }
        return response()->json($url);
    }
    
}
