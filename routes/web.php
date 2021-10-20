<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\CellierBouteilleController;

Route::get('/cellier', [CellierBouteilleController::class, 'index']);

Route::get('/ajouterBouteille/{idCellier}/{idBouteille}', [CellierBouteilleController::class, 'ajouterBouteille'])->name('ajouterBouteille');







Route::get('/boireBouteille/{cellier}', [CellierBouteilleController::class, 'boireBouteille'])->name('boireBouteille');


Route::get('/cellier/create', [CellierBouteilleController::class, 'create'])->name('ajouterNouveauBouteille');