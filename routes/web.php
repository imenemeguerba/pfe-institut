<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Route /dashboard — redirection intelligente selon le rôle
|--------------------------------------------------------------------------
| Quand l'utilisateur se connecte, Breeze le redirige vers /dashboard.
| Cette route le redirige automatiquement vers son espace selon son rôle.
*/

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isEstheticienne()) {
        return redirect()->route('estheticienne.dashboard');
    }

    if ($user->isClient()) {
        return redirect()->route('client.dashboard');
    }

    // Cas improbable mais sécurité
    abort(403, 'Rôle utilisateur non reconnu.');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes du profil (commun à tous les utilisateurs connectés)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes ADMIN (préfixe /admin, middleware admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');

        // Catégories — CRUD complet
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::patch('categories/{category}/toggle', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleActif'])
            ->name('categories.toggle');

        // Services — CRUD complet
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::patch('services/{service}/toggle', [\App\Http\Controllers\Admin\ServiceController::class, 'toggleActif'])
            ->name('services.toggle');
    });

/*
|--------------------------------------------------------------------------
| Routes ESTHÉTICIENNE (préfixe /esthe, middleware estheticienne)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'estheticienne'])
    ->prefix('esthe')
    ->name('estheticienne.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Estheticienne\DashboardController::class, 'index'])
            ->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Routes CLIENT (préfixe /client, middleware client)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'client'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])
            ->name('dashboard');
    });

require __DIR__.'/auth.php';