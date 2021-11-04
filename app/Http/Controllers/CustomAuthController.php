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
            'nom' =>'required|max:25|min:2|unique:users',
            'courriel' => 'required|email:rfc,filter|unique:users',
            'password' => 'required|min:6|max:20',
            'date_naissance' => 'required|date_format:Y-m-d|before:'.Carbon::now()->subYears(18)->format('Y-m-d').'|after:'. Carbon::now()->subYears(100)->format('Y-m-d')     

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
          'password' => 'required'
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

    if(Auth::check()){
      $id = Auth::user()->id;
      $nom = Auth::user()->nom;
      $courriel = Auth::user()->courriel;
      $date_naissance = Auth::user()->date_naissance;
    }

      return view('user.dashboard', ['nom' => $nom,
                                     'courriel' => $courriel,
                                     'date_naissance' => $date_naissance,
                                     'id'=> $id
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
      $id = $user->id;
      $nom = $user->nom;
      $courriel = $user->courriel;
      $date_naissance = $user->date_naissance;

      return view('user.usermodifie', ['nom' => $nom,
                                       'courriel' => $courriel,
                                       'date_naissance' => $date_naissance,
                                       'id' => $id
                                      ]);
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
      $request->validate([
        'nom' =>'required|max:25|min:2',
        'courriel' => 'required|email:rfc,filter',
        'password' => 'required|min:6|max:20',
        'date_naissance' => 'required|date_format:Y-m-d|before:'.Carbon::now()->subYears(18)->format('Y-m-d').'|after:'. Carbon::now()->subYears(100)->format('Y-m-d')     
    ]);

      $oldPassword = $user->password;
      $password = $request->password;
      $id = $user->id;
      $bool = Hash::check($password, $oldPassword);
      if ($bool) {
        $user->fill($request->all());
        $user->update([
          'nom' => $request->nom,
          'courriel' => $request->courriel,
          'date_naissance' => $request->date_naissance,
          'password'=> $oldPassword
        ]);
        return redirect('dashboard');
        // return redirect()->intended('dashboard');
      }

      return redirect('/user/'.$id.'/edit')->withSuccess('Le mot de passe n\'est pas valides!');

    }

    public function modifiePassword(user $user)
    {
      $id = $user->id;
      return view('user.passwordmodifie', ['id' => $id,'user' => $user]);
    }

    public function passwordupdate(Request $request, user $user)
    {
      $request->validate([
        'old_password' => 'required|min:6|max:20',
        'nouveau_password' => 'required|min:6|max:20|confirmed',
        // 'password_confirmation' => 'required|min:6|max:20'

    ]);

      $oldPassword = $user->password;
      $password = $request->password;
      $bool = Hash::check($password, $oldPassword);
      if ($bool) {
        $user->fill($request->all());
        $user->update([

          'password'=> $newPassword
        ]);
        return redirect('dashboard');
        // return redirect()->intended('dashboard');
      }

      return redirect('/user/'.$id.'/edit')->withSuccess('Le mot de passe n\'est pas valides!');

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
