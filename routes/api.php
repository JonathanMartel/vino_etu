<?php

use App\Http\Controllers\BouteilleAcheteeController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CellierBouteilleAcheteeController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\UnionsController;
use App\Http\Controllers\UserController;
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

// Générer les ressources nécessaires par défaut
Route::apiResource("user", UserController::class)->only(
    "store",
);

// Pour ces modèles, ne rendre que l'obtention de la liste complète comme disponible
Route::apiResource('pays', PaysController::class)->parameters(["pays" => "pays"])->only([
    "index",
]);

Route::apiResource('categories', CategorieController::class)->only([
    "index",
]);

Route::apiResource("bouteilles", BouteilleController::class)->only([
    "index",
    "show",
]);

Route::get("catalogue-bouteilles", [BouteilleController::class, "index"]);

// Afficher les bouteilles d'un cellier
Route::get('celliers/{cellierId}/bouteilles', [CellierController::class, "obtenirBouteilles"]);

// Ajout d'une bouteille à un cellier
Route::post('celliers/{cellier}/bouteilles', [CellierBouteilleAcheteeController::class, "store"]);

// Récupérer le data d'une bouteille achetée
Route::get('bouteilles-achetees/{bouteilleAchetee}', [BouteilleAcheteeController::class, "show"]);

// Mise à jour de l'inventaire d'une bouteille dans un cellier donné
Route::put("celliers/modifier-bouteille/{bouteilleAchetee}", [CellierBouteilleAcheteeController::class, "modifierInventaireBouteille"]);

// Mise à jour de l'inventaire d'une bouteille dans un cellier donné
Route::put("celliers/modifier-inventaire/{cellierBouteilleId}", [CellierBouteilleAcheteeController::class, "modifierInventaireBouteille"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
