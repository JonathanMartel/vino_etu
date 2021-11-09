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

    $response = [
        'utilisateur' => $utilisateur,
        'token' => $token,
    ];

    return response($response, 201);
  }

  /**
   * Connection
   *
   * @return \Illuminate\Http\Response
   */

    public function connection(Request $request)
    {

        $login = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $utilisateur = User::Where('email', $login['email'])->first();

        if (!$utilisateur || !Hash::check($login["password"], $utilisateur->password)){
            return response()->json([
                'message' => 'Mauvaise combinaison'
            ], 401);
        }


        $token = $utilisateur->createToken('myapptoken')->plainTextToken;

        $response = [
            'utilisateur' => $utilisateur,
            'token' => $token,
        ];

        return response()->json($response, 201);

    }


    public function deconnexion(Request $request){

        auth()->user()->tokens()->delete();

        // Rapport journalier 
        //$request->currentAccessToken()->delete();

        $response = [
            'status'=>true,
            'message'=>'Logout successfully',
        ];

        return response()->json($response, 201);
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
