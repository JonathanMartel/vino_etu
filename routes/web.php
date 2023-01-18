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

Route::post('/login/administrator', [AdminController::class, 'login'])->name('admin.login');

//faut se connecter pour voir dashboard 
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');


Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout')->middleware('admin');

Route::get('/register', [AdminController::class, 'adminRegister'])->name('admin.register');

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
