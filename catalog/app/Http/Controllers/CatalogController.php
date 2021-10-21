<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function home(){
        return view('catalog-home');
    }

    public function catalogvideo(){
        return view('catalog-catalogvideo');
    }

    public function about(){
        return view('catalog-about');
    }

    public function contact(){
        return view('catalog-contact', ['data[]'=> null]);
    }

    public function contactResult(Request $request){
        return view('catalog-contactResult', ['data'=> $request]);
    }
}
