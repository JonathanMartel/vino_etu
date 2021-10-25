<?php

use App\Http\Controllers\AngularController;
use Database\Seeders\BouteilleSeeder;
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

Route::get('/seed-saq', function () {
    BouteilleSeeder::getProduitsParCategorie();
});

Route::any('/{any}', [AngularController::class, "index"])->where("any", "^(?!api).*$");
