<?php

namespace App\Http\Controllers;

class AngularController extends Controller {

    // Servir la vue renfermant le déploiment d'Angular
    public function index() {
        return view("angular");
    }
}
