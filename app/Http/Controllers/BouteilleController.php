<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bouteille;

use Illuminate\Support\Facades\DB;

class BouteilleController extends Controller
{
    //
    public function index()
    {
        return view('bouteille.liste', [
            'data' => Bouteille::get(),
            'msg'=> NULL
        ]);
    }
}
