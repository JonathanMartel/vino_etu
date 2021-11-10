<?php

namespace App\Http\Controllers;

use App\Models\Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CellierController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function afficherCelliersParUtilisateur(Request $request) {
        return Cellier::obtenirCelliersParUtilisateur($request->userId);
    }

    /**
     *
     * Récupérer les bouteilles contenu dans un cellier donné.
     *
     * @param int|string $cellierId l'id du cellier d'on on veut afficher l'inventaire
     */
    public function obtenirBouteilles(Request $request, int $cellierId) {

        // Bâtir le tableau de filtres
        $filtres = $this->batirTableauFiltres($request);

        return Cellier::obtenirBouteillesParCellier(
            $cellierId,
            24,
            "nom",
            "asc",
            (!empty($filtres)) ? $filtres : null
        );
    }

    /**
     *
     * Bâtir le tableau de filtres à partir des paramètres reçus en requête
     *
     * @param Request $request objet request avec les filtres
     * @return array
     *
     */
    private function batirTableauFiltres(Request $request) {
        $filtres = [];

        if ($request->texteRecherche && $request->texteRecherche !== "") {
            $filtres["texteRecherche"] = $request->texteRecherche;
        }

        return $filtres;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function show(Cellier $cellier) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cellier $cellier) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cellier  $cellier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cellier $cellier) {
        //
    }
}
