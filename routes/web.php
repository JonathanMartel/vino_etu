<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellierBouteilleController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CellierController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

/* Redirection de l'accueil vers la liste des celliers */

Route::get('/', function () {
    return redirect('/cellier');
});


/*
|--------------------------------------------------------------------------
| Cellier
|--------------------------------------------------------------------------
|
*/

/* Page d'accueil : Liste des celliers */

Route::get('/cellier', [CellierController::class, 'index'])->name('cellier')->middleware('auth');

/* Page d'un cellier avec les vins correspondants, leur quantité et millesime */
Route::get('/cellier/{cellier}', [CellierController::class, 'show'])->name('cellier.show')->middleware('auth');

/* Page d'ajout d'un cellier  */
Route::get('/create/cellier', [CellierController::class, 'create'])->name('cellier.create')->middleware('auth');
Route::post('/create/cellier', [CellierController::class, 'store'])->name('cellier.store')->middleware('auth');

Route::get('/cellier/{cellier}/edit', [CellierController::class, 'edit'])->middleware('auth')->name('cellier.edit');
Route::put('/cellier/{cellier}/edit', [CellierController::class, 'update'])->middleware('auth')->name('cellier.update');

Route::delete('/cellier/{cellier}', [CellierController::class, 'destroy'])->middleware('auth')->name('cellier.destroy');

/*
|--------------------------------------------------------------------------
| Login & registration reRoutes
|--------------------------------------------------------------------------
|
*/

Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/registration', [CustomAuthController::class, 'create'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'store'])->name('register.custom');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::get('/user/{user}/edit', [CustomAuthController::class, 'edit'])->middleware('auth')->name('custom.edit');
Route::put('/user/{user}/edit', [CustomAuthController::class, 'update'])->middleware('auth')->name('custom.update');

/*
|--------------------------------------------------------------------------
| Bouteille dans un cellier
|--------------------------------------------------------------------------
|
*/

Route::get('/ajouterBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'ajouterBouteille'])->name('ajouterBouteille')->middleware('auth');
Route::get('/boireBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'boireBouteille'])->name('boireBouteille')->middleware('auth');
Route::get('/cellier/{idCellier}/ajouterVin', [CellierBouteilleController::class, 'create'])->name('ajouterVin')->middleware('auth');
Route::post('/cellierBouteille/store', [CellierBouteilleController::class, 'store'])->name('cellierBouteille.store')->middleware('auth');
Route::get('/obtenirMillesimesParBouteille/{idCellier}/{idBouteille}', [CellierBouteilleController::class, 'obtenirMillesimesParBouteille'])->name('obtenirMillesimesParBouteille')->middleware('auth');
Route::get('/ajouterNote/{idCellier}/{idBouteille}/{millesime}/{note}', [CellierBouteilleController::class, 'ajouterNote'])->name('ajouterNote')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Bouteille
|--------------------------------------------------------------------------
|
*/

/* Recherche */

Route::get('/rechercheBouteillesParMotCle/{motCle}', [BouteilleController::class, 'rechercheBouteillesParMotCle'])->name('rechercheBouteillesParMotCle')->middleware('auth');
Route::get('/importerBouteille', [BouteilleController::class, 'index'])->name('importerBouteille')->middleware('auth');
