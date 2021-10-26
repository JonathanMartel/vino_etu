<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CellierBouteilleController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CustomAuthController;
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

/*
|--------------------------------------------------------------------------
| Login & registration reRoutes
|--------------------------------------------------------------------------
|
*/

Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('/registration', [CustomAuthController::class, 'create']);
Route::post('custom-registration', [CustomAuthController::class, 'store'])->name('register.custom');
Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->middleware('auth');







Route::get('/cellier', [CellierBouteilleController::class, 'index'])->name('cellier');

Route::get('/ajouterBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'ajouterBouteille'])->name('ajouterBouteille');
Route::get('/rechercheBouteilles/{motCle}', [BouteilleController::class, 'rechercheBouteilles'])->name('rechercheBouteilles');






Route::get('/boireBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'boireBouteille'])->name('boireBouteille');


Route::get('/cellierBouteille/create', [CellierBouteilleController::class, 'create'])->name('ajouterNouvelleBouteille');
Route::post('/cellierBouteille/store', [CellierBouteilleController::class, 'store'])->name('cellierBouteille.store');
Route::get('/rechercheCellierBouteille/{idCellier}/{idBouteille}/{millesime}', [CellierBouteilleController::class, 'rechercheCellierBouteille'])->name('rechercheCellierBouteille');