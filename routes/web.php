<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAQController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\RechercheController;
use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\FallbackController;

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

// Route::get('/', function () {
//     return view('home');
// });

//Section page d'accueil
Route::get('/', AcceuilController::class)->name('acceuil');




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

/*
    Section fait par Fabio DASHBOARD
*/
Route::get('/dashboard', function () {
    return view('dashboard');
});


//aller login apres register
Route::get('/utilisateur/login', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';




/**** ROUTE TEST ET IMPORTE CATALOGUE *** */

// Permet de tester rapidement la connection*/
Route::get('/testDB', function () {
    return view('testDB');
});

// Importe le catalogue de la SAQ*/
Route::get('/SAQ', [SAQController::class, 'import'])
    ->name('bouteille.updateSAQ');




/****************CELLIER *********/

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




/****************BOUTEILLE *********/

// Route pour Liste bouteille
Route::get('/bouteille', [BouteilleController::class, 'index'])
    ->name('bouteille.liste');

// Ajout d'une bouteille
Route::get('/bouteille/nouveau', [BouteilleController::class, 'nouveau'])
    ->name('bouteille.nouveau');

Route::post('/bouteille/recherche', [BouteilleController::class, 'recherche'])
->name('bouteille.recherche');


Route::post('/bouteille/creer', [BouteilleController::class, 'creer'])
->name('bouteille.creer');

// Édition d'une bouteille
Route::get('/bouteille/edit/{id}', [BouteilleController::class, 'edit'])
->name('bouteille.edit');
Route::post('/bouteille/update/{id}', [BouteilleController::class, 'update'])
->name('bouteille.update');


// Suppression d'un bouteille
Route::post('/bouteille/supprime/{id}', [BouteilleController::class, 'bouteille'])
->name('bouteille.supprime');


// Route Fallback pour les routes non existantes Page Erreur 404
Route::fallback(FallbackController::class);
