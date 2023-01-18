<?php


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAQController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Permet de tester rapidement la connection*/
Route::get('/testDB', function () {
    return view('testDB');
});

// Importe le catalogue de la SAQ*/
Route::get('/SAQ', [SAQController::class, 'import'])
    ->name('bouteille.updateSAQ');

// Route pour Liste bouteille
Route::get('/', [BouteilleController::class, 'index'])
    ->name('bouteille.liste');

/* CELLIER */
Route::get('/cellier', [CellierController::class, 'index'])
    ->name('cellier.index'); 

// Ajout d'un cellier
Route::get('/cellier/nouveau', [CellierController::class, 'nouveau'])
    ->name('cellier.nouveau'); 
Route::post('/cellier/creer', [CellierController::class, 'creer'])
->name('cellier.creer'); 


// Édition d'un cellier
Route::get('/cellier/edit/{id}', [CellierController::class, 'edit'])
->name('cellier.edit');
Route::post('/cellier/update/{id}', [CellierController::class, 'update'])
->name('cellier.update');

// Suppression d'un cellier
Route::post('/cellier/supprime/{id}', [CellierController::class, 'supprime'])
->name('cellier.supprime'); 

/* Bouteille */

// Ajout d'une bouteille
Route::get('/bouteille/nouveau', [BouteilleController::class, 'nouveau'])
    ->name('bouteille.nouveau');

Route::post('/bouteille/recherche', [BouteilleController::class, 'recherche'])
->name('bouteille.recherche');


Route::post('/bouteille/creer', [BouteilleController::class, 'creer'])
->name('bouteille.creer'); 


