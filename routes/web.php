<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckInstallation;

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    $user = Auth::user(); // Use the Auth facade explicitly
    return view('dashboard', ['user' => $user]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/install', [InstallerController::class, 'showForm'])->name('install.form');

Route::post('/install', [InstallerController::class, 'processForm'])->name('install.process');

require __DIR__.'/auth.php';
