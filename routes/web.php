<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\SAQController;
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

/***Admin Route */
Route::prefix('admin')->group(function (){

Route::get('/login', [AdminController::class, 'index'])->name('login_form');

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

}); 

/***End Admin Route */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route pour Liste bouteille
Route::get('/bouteille', [BouteilleController::class, 'index'])
    ->name('bouteille');

Route::get('/SAQ', [SAQController::class, 'import'])
    ->name('bouteille.updateSAQ');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
