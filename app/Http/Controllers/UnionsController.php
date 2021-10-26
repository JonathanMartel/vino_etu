<?php

namespace App\Http\Controllers;

use App\Models\Unions;
use Illuminate\Http\Request;

class UnionsController extends Controller
{
    public function obtenirSuggestionsNoms() {
        dd(Unions::obtenirSuggestionsNomsDeBouteilles());
    }
}
