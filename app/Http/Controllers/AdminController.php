<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }//end method 

    public function dashboard(){
        return view('admin.index');
    }//end method 

    public function login(Request $request){
        dd($request->all());
    }//end method 
}
