<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class CustomAuthController extends Controller
{


    private $apiToken;
    public function __construct()
    {
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


   /**
   * Creation de compte utilisateur
   *
   * @return \Illuminate\Http\Response
   */
  public function creerCompte(Request $request)
  {

    $this->validate($request, [
      'first_name' => 'required|max:50|min:2',
      'last_name' => 'required|max:50|min:2',
      'city' => 'required|max:50|min:2',
      'dob' => 'required|date:Y-m-d',
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $utilisateur = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'city' => $request->city,
        'dob' => $request->dob,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $utilisateur->createToken('myapptoken')->plainTextToken;
    return response(['message' => 'Utilisateur enregistre.'], 200);
  }


  /**
   * Connection
   *
   * @return \Illuminate\Http\Response
   */

  public function connection(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login = $request->only('email', 'password');
        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credential!!'], 401);
        
        }
        $user = Auth::user();
        $token = $user->createToken('myapptoken')->plainTextToken;

        return response([
            'id' => $user->id,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'token' => $token->accessToken,
            'token_expires_at' => $token->token->expires_at,
        ], 200);

        //return redirect("connection")->withSuccess('Échec de la connexion');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
