<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public routes (tanpa login)
Route::get('/database-bank', [App\Http\Controllers\PublicController::class, 'databaseBank'])->name('database.bank');
Route::get('/edukasi', [App\Http\Controllers\PublicController::class, 'edukasi'])->name('edukasi');

Route::get('/dashboard', function () {
    return redirect()->route('simulations.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Simulation routes
    Route::get('/simulations', [SimulationController::class, 'index'])->name('simulations.index');
    Route::post('/simulations/calculate', [SimulationController::class, 'calculate'])->name('simulations.calculate');
    Route::post('/simulations/compare', [SimulationController::class, 'compare'])->name('simulations.compare');
    Route::post('/simulations/store', [SimulationController::class, 'store'])->name('simulations.store');
    Route::get('/simulations/history', [SimulationController::class, 'history'])->name('simulations.history');
    
    // Admin routes - require admin middleware
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
      // Users Management
Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])
    ->name('users.index');

Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])
    ->name('users.edit');

Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])
    ->name('users.update');

Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])
    ->name('users.destroy');


        // Articles Management
        Route::resource('articles', App\Http\Controllers\ArticleController::class);
        
        // Banks Management
        Route::resource('banks', App\Http\Controllers\Admin\BankController::class);
        
        // Simulations History
        Route::get('/simulations', [App\Http\Controllers\Admin\SimulationController::class, 'index'])->name('simulations.index');
        Route::get('/simulations/{simulation}', [App\Http\Controllers\Admin\SimulationController::class, 'show'])->name('simulations.show');
        Route::delete('/simulations/{simulation}', [App\Http\Controllers\Admin\SimulationController::class, 'destroy'])->name('simulations.destroy');
    });
});

require __DIR__.'/auth.php';