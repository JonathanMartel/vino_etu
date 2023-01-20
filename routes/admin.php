<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

Route::middleware('auth', 'is_admin')->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard'); 
});