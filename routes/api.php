<?php

use App\Http\Controllers\BouteilleAcheteeController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CellierBouteilleAcheteeController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\UnionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomAuthController;
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

// Récupérer le data d'une bouteille achetée
Route::get('bouteilles-achetees/{bouteilleAchetee}', [BouteilleAcheteeController::class, "show"]);

// Creation d'une compte utilisateur
Route::post('creerCompte', [CustomAuthController::class, "creerCompte"]);

// Connexion
Route::post('connection', [CustomAuthController::class, "connection"]);


// Afficher les bouteilles d'un cellier
Route::get('celliers/{cellierId}/bouteilles', [CellierController::class, "obtenirBouteilles"]);

// route protéger

Route::group(['middleware' => ["auth:sanctum"]], function () {

    // Ajout d'une bouteille à un cellier
    Route::post('celliers/{cellier}/bouteilles', [CellierBouteilleAcheteeController::class, "store"]);

    // Mise à jour des informations d'une bouteille dans un cellier donné
    Route::put("celliers/modifier-bouteille/{bouteilleAchetee}", [BouteilleAcheteeController::class, "modifierInventaireBouteille"]);

    // Mise à jour de l'inventaire d'une bouteille dans un cellier donné
    Route::put("celliers/modifier-inventaire/{cellierBouteilleId}", [CellierBouteilleAcheteeController::class, "modifierInventaireBouteille"]);

    // Modifier le data d'une bouteille achetée
    Route::put('bouteilles-achetees/{bouteilleAchetee}', [BouteilleAcheteeController::class, "update"]);

    // Supprimer une bouteille
    Route::delete('supprimer/{CellierBouteilleAchetee}', [CellierBouteilleAcheteeController::class, "supprimerBouteille"]);

    //Deconnexion
    Route::post('deconnexion', [CustomAuthController::class, "deconnexion"]);

});

