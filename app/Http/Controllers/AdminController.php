<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin_login');
    }//end method 

    public function dashboard(){
        return view('admin.index');
    }//end method 

    public function login(Request $request){
        //dd($request->all());
        $check = $request->all(); 
        if(Auth::guard('admin')->attempt(['email' => $check['email'],'password' => $check['password']  ])){
            return redirect()->route('admin.dashboard')->with('error', 'Admin Login Successfully');
        }else{
            return back()->with('error', 'Invalid Email or Password');
        }
    }//end method 

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'Admin Logout Successfully');
    }

    public function adminRegister()
    {
        return view('admin.admin_register');
    }
}
