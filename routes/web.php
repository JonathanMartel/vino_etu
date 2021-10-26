<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellierBouteilleController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CustomAuthController;
<<<<<<< HEAD

=======
use App\Http\Controllers\CellierController;
>>>>>>> f2c9486bffc36df50db35e5fa52b9ab570b7020a
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

Route::get('/', function () {
    return view('welcome');
});

/* Page d'accueil : Liste des celliers */

Route::get('/home', [CellierController::class, 'index'])->name('home');

/* Page d'un cellier avec les vins correspondants, leur quantité et millesime */
Route::get('/cellier/{cellier}', [CellierController::class, 'show']);


/* Page d'ajout d'un cellier  */
Route::get('/create/cellier', [CellierController::class, 'create']);
Route::post('/create/cellier', [CellierController::class, 'store']);





Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/registration', [CustomAuthController::class, 'create'])->name('inscription');


<<<<<<< HEAD
=======


/* ??? ette route ou celle plus haut ??? */
>>>>>>> f2c9486bffc36df50db35e5fa52b9ab570b7020a
Route::get('/cellier', [CellierBouteilleController::class, 'index'])->name('cellier');
Route::get('/ajouterBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'ajouterBouteille'])->name('ajouterBouteille');
Route::get('/boireBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'boireBouteille'])->name('boireBouteille');
Route::get('/cellierBouteille/create', [CellierBouteilleController::class, 'create'])->name('ajouterNouvelleBouteille');
Route::post('/cellierBouteille/store', [CellierBouteilleController::class, 'store'])->name('cellierBouteille.store');


Route::get('/rechercheBouteilles/{motCle}', [BouteilleController::class, 'rechercheBouteilles'])->name('rechercheBouteilles');

