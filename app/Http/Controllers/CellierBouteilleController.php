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
        $celliers = Cellier::getCelliersByUser(session('user')->id);

$cellierBouteillesIDs = CellierBouteille::getCellierBouteillesIDs($idCellier);

/* $cellierBouteillesByIDs = [
        "id" => '',
        "nom" => "",
        "pays" => "",
        "format" => "",
        "taille" => "",
        "url_img" => "",
    
    "dataCellier" => [],
]; */



foreach ($cellierBouteillesIDs as $bouteilleID){

    $bouteille = Bouteille::getDataBouteilleByID($bouteilleID->bouteille_id); //infos générales de la bouteille obtenue grace a son ID
    $dataCellierBouteillesByIDs = CellierBouteille::getDataCellierBouteillesByID($idCellier, $bouteilleID->bouteille_id); //

    $cellierBouteillesByIDs[$bouteilleID->bouteille_id] = [
            "id" => $bouteilleID->bouteille_id,
            "nom" => $bouteille[0]->nom,
            "pays" => $bouteille[0]->pays,
            "type" => $bouteille[0]->type,
            "format" => $bouteille[0]->format,
            "taille" => $bouteille[0]->taille,
            "url_img" => $bouteille[0]->url_img,
            "url_saq" => $bouteille[0]->url_saq,
            "dataCellier" => $dataCellierBouteillesByIDs,
    ];

    //var_dump($cellierBouteillesByIDs);
}


        return view('cellierBouteille.index', [
            'cellierBouteilles' => $cellierBouteilles,
            'cellier' => $cellier,
          'cellierBouteillesByIDs' => $cellierBouteillesByIDs ?? [],
            'celliers' => $celliers
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

        $date_achat = null;

        if (isset($request->date_achat)) {
            $date_achat = date('Y-m-d', strtotime($request->date_achat));
        }

        $millesime = 0;
        
        if (!empty($request->millesime)) {
            $millesime = $request->millesime;
        }

        $request->validate([
            'nom' => 'required|max:111',
            'quantite' => 'integer|gte:0',
            'prix' => 'numeric|regex:/[0-9]+(\.[0-9][0-9]?)?/|gte:0|max:100000',
            'pays' => 'nullable|regex:^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑa-zàâçéèêëîïôûùüÿñ]+$^',
            'type_id' => 'required|exists:types,id',
            'format_id' => 'required|exists:formats,id',
        ]);

        /**
         * Vérifier si la bouteille existe dans la table cellier_bouteilles et le vin dans la table bouteilles
         * Si oui indique qu'elle existe déjà
         * Sinon si elle n'existe pas dans table bouteille, la créer et ajouter dans la table cellier_bouteille
         * Si la bouteille existe dans la table bouteillesm l'ajouter dans la table cellier_bouteilles
         */
        if (isset($request->bouteille_id)) {
            $cellierBouteille = CellierBouteille::rechercheCellierBouteille($request->cellier_id, $request->bouteille_id, $millesime);
            $bouteilleExistante = Bouteille::rechercheBouteilleExistante($request);

            if (isset($bouteilleExistante[0]) && isset($cellierBouteille[0])) {

                return back()->withInput()->with('erreur', "Bouteille existe déjà");
            } else {

                if (isset($bouteilleExistante[0])) {

                    $cellierBouteille = new CellierBouteille;
                    $cellierBouteille->fill($request->all());
                    $cellierBouteille->date_achat = $date_achat;
                    $cellierBouteille->millesime =  $millesime;
                    $cellierBouteille->save();

                    return redirect("cellier/" . $request->cellier_id)->withInput()->with("nouvelleBouteille", "nouvelle bouteille ajoutée");
                } else {

                    if ($request->file) {
                        $fileName = time() . '_' . $request->file->getClientOriginalName();
                        $request->file('file')->move(public_path() . '/img', $fileName);
                        $request->url_img = URL::to('') . '/img/' . $fileName;
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
                    $cellierBouteille->millesime =  $millesime;
                    $cellierBouteille->date_achat = $date_achat;
                    $cellierBouteille->save();

                    return redirect("cellier/" . $request->cellier_id)->withInput()->with("nouvelleBouteille", "nouvelle bouteille ajoutée");
                }
            }
        } else {
            if ($request->file) {
                $fileName = time() . '_' . $request->file->getClientOriginalName();
                $request->file('file')->move(public_path() . '/img', $fileName);
                $request->url_img = URL::to('') . '/img/' . $fileName;
            } else {
                $request->url_img = URL::to('') . "/assets/icon/bouteille-cellier.svg";
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
            $cellierBouteille->millesime =  $millesime;
            $cellierBouteille->save();

            return redirect("cellier/" . $request->cellier_id)->withInput()->with("nouvelleBouteille", "nouvelle bouteille ajoutée");
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
