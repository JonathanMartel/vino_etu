<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;
use App\Models\Type;
use App\Models\CellierBouteille;
use App\Models\Format;
use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CellierBouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($idCellier)
    {
        $cellierBouteilles = CellierBouteille::obtenirListeBouteilleCellier($idCellier); 
        $cellier = Cellier::find($idCellier);

	    return view('cellierBouteille.index', [
            'cellierBouteilles' => $cellierBouteilles,
            'idCellier' => $idCellier,
            'cellier' => $cellier,
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
        $date_achat = 0; 

        if(!isset($request->millesime)) {
            $request->millesime = 0;
        }

        $request->validate([
            'nom' => 'required',
            'quantite' => 'integer|gte:0',
            'prix' => 'numeric|regex:/[0-9]+(\.[0-9][0-9]?)?/|gte:0',
            'pays' => 'nullable|regex:^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑÆŒa-zàâçéèêëîïôûùüÿñæœ]+$^',
            'type_id' => 'required|exists:types,id',
            'format_id' => 'required|exists:formats,id',
        ]);
      
        // Vérifier si la bouteille existe dans la table cellier_bouteilles et le vin dans la table bouteilles
       if(isset($request->bouteille_id)){
            $cellierBouteille = CellierBouteille::rechercheCellierBouteille($request->cellier_id, $request->bouteille_id, $request->millesime);
            $bouteilleExistante = Bouteille::rechercheBouteilleExistante( $request);
            
            if( isset($bouteilleExistante[0]) && isset($cellierBouteille[0])){
                return back()->withInput()->with('erreur', "Bouteille existe déjà");
            }else {

               
                if(isset($request->date_achat)){
                    
                    $date_achat = date('Y-m-d', strtotime($request->date_achat));
                   
                }
            if(isset($bouteilleExistante[0])) {
 
                    $cellierBouteille = new CellierBouteille;
                    $cellierBouteille->fill($request->all());
                    $cellierBouteille->date_achat = $date_achat;
                    $cellierBouteille->save();
                    
                    return redirect("cellier")->with("nouvelleBouteille", "nouvelle bouteille ajoutée" );
                }else {

                    if($request->file) {
                        $fileName = time().'_'.$request->file->getClientOriginalName();
                        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                        $request->url_img = URL::to(''). "/storage/" . $filePath;
                    }

                    $bouteille = Bouteille::create([

                        'nom' => $request->nom,
                        'pays' => $request->pays,
                        'description' =>  $request->description,
                        'format_id' =>  $request->format_id,
                        'url_img' => $request->url_img,
                        'type_id' =>  $request->type_id,
                        'user_id' =>  session('user')->id
                    ]);
                
                    $cellierBouteille = new CellierBouteille;
                    $cellierBouteille->fill($request->all());
                    $cellierBouteille->bouteille_id = $bouteille->id;
                    $cellierBouteille->date_achat = $date_achat;
                    $cellierBouteille->save();
                    
                    return redirect("cellier/". $request->cellier_id)->with("nouvelleBouteille", "nouvelle bouteille ajoutée" );
                }
            }
        }else {
            if($request->file) {
                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $request->url_img = URL::to(''). "/storage/" . $filePath;
            }else {
                $request->url_img = URL::to(''). "/assets/icon/bouteille-cellier.svg";
    
            }

            $bouteille = Bouteille::create([

                'nom' => $request->nom,
                'pays' => $request->pays,
                'description' =>  $request->description,
                'format_id' =>  $request->format_id,
                'url_img' => $request->url_img,
                'type_id' =>  $request->type_id,
                'user_id' =>  session('user')->id
            ]);
        
            $cellierBouteille = new CellierBouteille;
            $cellierBouteille->fill($request->all());
            $cellierBouteille->bouteille_id = $bouteille->id;
            $cellierBouteille->date_achat = $date_achat;
            $cellierBouteille->save();
            
            return redirect("cellier/". $request->cellier_id)->with("nouvelleBouteille", "nouvelle bouteille ajoutée" );
        }
        
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
