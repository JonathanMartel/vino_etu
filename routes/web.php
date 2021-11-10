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

Route::get('/cellier', [CellierController::class, 'index'])->name('cellier')->middleware('auth')->middleware('prevent-back-history');

/* Page d'un cellier avec les vins correspondants, leur quantité et millesime */
Route::get('/cellier/{cellier}', [CellierController::class, 'show'])->name('cellier.show')->middleware('auth')->middleware('prevent-back-history');

/* Page d'ajout d'un cellier  */
Route::get('/create/cellier', [CellierController::class, 'create'])->name('cellier.create')->middleware('auth')->middleware('prevent-back-history');
Route::post('/create/cellier', [CellierController::class, 'store'])->name('cellier.store')->middleware('auth')->middleware('prevent-back-history');

Route::get('/cellier/{cellier}/edit', [CellierController::class, 'edit'])->middleware('auth')->name('cellier.edit')->middleware('prevent-back-history');
Route::put('/cellier/{cellier}/edit', [CellierController::class, 'update'])->middleware('auth')->name('cellier.update')->middleware('prevent-back-history');

Route::delete('/cellier/{cellier}', [CellierController::class, 'destroy'])->middleware('auth')->name('cellier.destroy')->middleware('prevent-back-history');

/*
|--------------------------------------------------------------------------
| Login & registration reRoutes
|--------------------------------------------------------------------------
|
*/

Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/registration', [CustomAuthController::class, 'create'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'store'])->name('register.custom')->middleware('prevent-back-history');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth')->name('dashboard')->middleware('prevent-back-history');
Route::get('/user/{user}/edit', [CustomAuthController::class, 'edit'])->middleware('auth')->name('custom.edit')->middleware('prevent-back-history');
Route::put('/user/{user}/edit', [CustomAuthController::class, 'update'])->middleware('auth')->name('custom.update')->middleware('prevent-back-history');
Route::get('/user/{user}/password', [CustomAuthController::class, 'modifiePassword'])->middleware('auth')->name('password.edit')->middleware('prevent-back-history');
Route::put('/user/{user}/password', [CustomAuthController::class, 'passwordupdate'])->middleware('auth')->name('password.update')->middleware('prevent-back-history');


/*
|--------------------------------------------------------------------------
| Bouteille dans un cellier
|--------------------------------------------------------------------------
|
*/

Route::get('/ajouterBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'ajouterBouteille'])->name('ajouterBouteille')->middleware('auth')->middleware('prevent-back-history');
Route::get('/boireBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'boireBouteille'])->name('boireBouteille')->middleware('auth');
Route::get('/cellier/{idCellier}/ajouterVin', [CellierBouteilleController::class, 'create'])->name('ajouterVin')->middleware('auth')->middleware('prevent-back-history');
Route::post('/cellierBouteille/store', [CellierBouteilleController::class, 'store'])->name('cellierBouteille.store')->middleware('auth')->middleware('prevent-back-history');
Route::get('/obtenirMillesimesParBouteille/{idCellier}/{idBouteille}', [CellierBouteilleController::class, 'obtenirMillesimesParBouteille'])->name('obtenirMillesimesParBouteille')->middleware('auth')->middleware('prevent-back-history');
Route::get('/ajouterNote/{idCellier}/{idBouteille}/{millesime}/{note}', [CellierBouteilleController::class, 'ajouterNote'])->name('ajouterNote')->middleware('auth')->middleware('prevent-back-history');

Route::get('/obtenirMillesime/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'obtenirMillesime'])->name('obtenirMillesime')->middleware('auth')->middleware('prevent-back-history');

/*
|--------------------------------------------------------------------------
| Bouteille
|--------------------------------------------------------------------------
|
*/
// Route::get('/vin/{bouteille}/edit', [BouteilleController::class, 'edit'])->middleware('auth')->name('bouteilleEdit')->middleware('auth')->middleware('prevent-back-history');
Route::get('/vin/{bouteille}/edit', [BouteilleController::class, 'edit'])->middleware('auth')->name('bouteilleEdit');

Route::put('/vin/{bouteille}/edit', [BouteilleController::class, 'update'])->middleware('auth')->name('bouteilleUpdate')->middleware('auth')->middleware('prevent-back-history');

/*
|--------------------------------------------------------------------------
|Fiche Vin
|--------------------------------------------------------------------------
|
*/

Route::get('/cellier/{idCellier}/{idBouteille}', [CellierBouteilleController::class, 'show'])->name('ficheVin')->middleware('auth')->middleware('prevent-back-history');

Route::get('/cellierBouteille/edit', [CellierBouteilleController::class, 'edit'])->middleware('auth')->name('cellierBouteille.edit')->middleware('prevent-back-history');





/* Recherche */

Route::get('/rechercheBouteilleExistante/{nom}/{type_id}/{format_id}/{pays?}', [BouteilleController::class, 'rechercheBouteilleExistante'])->name('rechercheBouteilleExistante')->middleware('auth')->middleware('prevent-back-history');
Route::get('/rechercheBouteillesParMotCle/{motCle}', [BouteilleController::class, 'rechercheBouteillesParMotCle'])->name('rechercheBouteillesParMotCle')->middleware('auth')->middleware('prevent-back-history');
Route::get('/rechercheDansCellier/{motCle}/{idCellier}', [CellierController::class, 'rechercheDansCellier'])->name('rechercheDansCellier')->middleware('auth')->middleware('prevent-back-history');
Route::get('/reinitialiserCellier/{idCellier}', [CellierController::class, 'reinitialiserCellier'])->name('reinitialiserCellier')->middleware('auth')->middleware('prevent-back-history');

Route::get('/importerBouteille', [BouteilleController::class, 'index'])->name('importerBouteille')->middleware('admin')->middleware('prevent-back-history');
Route::get('/obtenirListeSAQ', [BouteilleController::class, 'obtenirListeSAQ'])->name('obtenirListeSAQ')->middleware('admin')->middleware('prevent-back-history');




