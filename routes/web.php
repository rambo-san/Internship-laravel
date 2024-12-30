<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Authenticated dashboard route
Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', ['user' => $user]);
})->middleware(['auth'])->name('dashboard');

// Profile management routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/admin/manage-users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/manage-users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/manage-users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::patch('/admin/manage-users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/manage-users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/view-reports', [AdminController::class, 'viewReports'])->name('admin.view-reports');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.update.settings');
});

// Include authentication routes
require __DIR__.'/auth.php';