<?php

namespace App\Http\Controllers;

use App\Models\Bouteille;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Format;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File; 

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
	public function obtenirListeSAQ($page) {
        $nouvellesBouteilles = Bouteille::obtenirListeSAQ($page);
       
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
     * @param nom
     * @param type_id
     * @param format_id
     * @param pays
     * Rechercher dans la table bouteilles pour vérifier si une bouteille existe déjà
     * @return response une bouteille si existante ou rien
     */
    public function rechercheBouteilleExistante($nom, $type_id, $format_id, $pays = null) {
        $request = new Request();
        $request->nom = $nom;
        $request->pays = $pays;
        $request->type_id = $type_id;
        $request->format_id = $format_id;
        $bouteille = Bouteille::rechercheBouteilleExistante($request);
        return response()->json($bouteille);
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
    public static function store($request)
    {
        $request->validate([
            'nom' => 'required|max:111',
            'pays' => 'nullable|regex:^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑa-zàâçéèêëîïôûùüÿñ]+$^ | max:45',
            'description' => 'nullable | min:3 | max:1000',
            'type_id' => 'required|exists:types,id',
            'format_id' => 'required|exists:formats,id',
        ]);

        if ($request->file) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->move(public_path() . '/img', $fileName);
            $request->url_img = URL::to('') . '/img/' . $fileName;
        }else {
            $request->url_img = URL::to('') . '/assets/icon/bouteille-cellier.svg';
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
        return $bouteille;
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
        if($bouteille->user_id != session('user')->id)
            return redirect('/cellier');
        $types = Type::all();
        $formats = Format::all();
        // $idBouteille = $bouteille->id;
        /* var_dump($bouteille->format); */
        return view('bouteille.edit', [
                                        'bouteille'=> $bouteille,
                                        'types' => $types,
                                        'formats' => $formats,
                                        'idCellier' => session('idCellier') ?? 0,
                                        'idBouteille' =>$bouteille

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
        $request->validate([
            'nom' => 'required|max:111',
            'pays' => 'nullable|regex:^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑa-zàâçéèêëîïôûùüÿñ]+$^ | max:45',
            'description' => 'nullable | min:3 | max:1000',
            'code_saq' => 'max:50',
            'prix_saq' => 'numeric|regex:/[0-9]+(\.[0-9][0-9]?)?/|gte:0|max:100000', //prix maximum trouvé pour une bouteille : 100 000.00$
            'url_saq' => 'url',
            'type_id' => 'required | exists:types,id',
            'format_id' => 'required | exists:formats,id',
        ]);
        
        /**
         * Vérifier les informations entrées pour une modification appartiennent à une bouteille existante
         */
        $bouteilleExistante = Bouteille::rechercheBouteilleExistante($request);
        if(isset($bouteilleExistante[0]) && !$request->file) {
            return back()->withInput()->with('erreur', "Bouteille existe déjà");
        }else if(isset($bouteilleExistante[0]) && $request->file){
            if($bouteilleExistante[0]->id == $bouteille->id) {
              
                self::updateBouteille($bouteille, $request);
        
                return redirect(URL::to('') . '/cellier/'. session('idCellier') . '/'. $bouteille->id)->withInput()->with("modifieBouteille", "une bouteille modifiée");
            }else {
                return back()->withInput()->with('erreur', "Bouteille existe déjà");
            }
        }else {
            self::updateBouteille($bouteille, $request);
    
            return redirect(URL::to('') . '/cellier/'. session('idCellier') . '/'. $bouteille->id)->withInput()->with("modifieBouteille", "une bouteille modifiée");
        }   
      
    }

    public static function updateBouteille(Bouteille $bouteille, Request $request){
        $bouteille->fill($request->all());
    
        if ($request->file) {

            if($request->url_img != URL::to('') . '/assets/icon/bouteille-cellier.svg'){
                File::delete(public_path('img/' . explode('/',$request->url_img)[4]) );
            }
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            
            $request->file('file')->move(public_path() . '/img', $fileName);
            $bouteille->url_img = URL::to('') . '/img/' . $fileName;
        }
         $bouteille->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille)
    {
        $bouteille->delete();

        return redirect('/cellier/'.session('idCellier'))->withInput()->with("deleteBouteille", "une bouteille supprimée");
    }
}
