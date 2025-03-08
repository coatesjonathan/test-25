<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [CharacterController::class, 'index'])->name('home');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('character.show');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
