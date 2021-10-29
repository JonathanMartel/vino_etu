<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' =>'required|max:50|min:2|unique:users',
            'courriel' => 'required|email:rfc,filter|unique:users',
            'password' => 'required|min:6|max:20',
            'date_naissance' => 'required|date_format:Y-m-d|before:' . Carbon::now()->subYears(18)->format('Y-m-d')         
        ]);
   
          $user = new User;
          $user->fill($request->all());
          $user->password = Hash::make($request->password);
          $user->save();
   
        return redirect('login');
    }

    /**
     * Function se connecter.
     *
    */
    public function customLogin(Request $request){

        $request->validate([
          'courriel' => 'required|email:rfc,filter|exists:users,courriel',
<<<<<<< HEAD
          'password' => 'required|min:6'
=======
          'password' => 'required'
>>>>>>> c8bbe9531fccdebbf7a9b5b9ead2952d54673816
        ]);

        $credentials = $request->only('courriel', 'password');
        if(Auth::attempt($credentials)){
          session(['user' => Auth::user()]);
          return redirect()->intended('cellier');
        }

        return redirect('login')->withSuccess('Les informations de connexion ne sont pas valides!');

  }

    /*
    *
    * Le view pour dashboard.
    *
    */

  public function dashboard(){

    $nom = null;
    if(Auth::check()){
      $nom = Auth::user()->nom;
      $courriel = Auth::user()->courriel;
      $date_naissance = Auth::user()->date_naissance;

    }

      return view('user.dashboard', ['nom' => $nom,
                                     'courriel' => $courriel,
                                     'date_naissance' => $date_naissance
                                    ]);
}

    /**
     * Function se déconnecter.
     *
    */
    public function logout(){
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
