<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcceuilController extends Controller
{
    //Gestion page d'accueil on utilise la methode invoke pour appeler la page d'accueil car seul une fonction sera définit
    public function __invoke()
    {
        return view('acceuil.acceuil');
    }
}
