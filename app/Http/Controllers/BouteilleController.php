<?php

namespace App\Http\Controllers;

use App\Http\Resources\BouteilleResource;
use App\Models\Bouteille;
use Illuminate\Http\Request;

class BouteilleController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return BouteilleResource::collection(Bouteille::all());
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
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */

    public function show(Bouteille $bouteille) {

        return BouteilleResource::make($bouteille);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bouteille $bouteille) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bouteille  $bouteille
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bouteille $bouteille) {
        //
    }
}
