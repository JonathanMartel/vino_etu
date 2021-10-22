<?php

use App\Models\vino__bouteille;
use App\Models\vino__cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/cellier', function(){
 

    return response(vino__cellier::all(), 200);


});

Route::get('/bouteilles', function(){
  

    return response(vino__bouteille::all(), 200);


});
