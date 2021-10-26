<?php

namespace App\Http\Controllers;

use App\Models\Unions;
use Illuminate\Http\Request;

class UnionsController extends Controller
{
    public function obtenirCatalogueBouteilles() {
        return Unions::obtenirCatalogueBouteillesParUtilisateur(1);
    }
}
