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

use App\Http\Controllers\CellierController;

Route::get('/cellier', [CellierController::class, 'index']);
Route::get('/ajouterBouteille/{cellier}', [CellierController::class, 'ajouterBouteille'])->name('ajouterBouteille');
Route::get('/boireBouteille/{cellier}', [CellierController::class, 'boireBouteille'])->name('boireBouteille');
Route::get('/cellier/create', [CellierController::class, 'create'])->name('ajouterNouveauBouteille');