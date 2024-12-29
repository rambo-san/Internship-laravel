<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\IsAdmin;  // Import the IsAdmin middleware

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

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/admin/view-reports', [AdminController::class, 'viewReports'])->name('admin.view-reports');
    Route::get('/admin/settings', [AdminController::class, 'adminSettings'])->name('admin.settings');
});

require __DIR__.'/auth.php';
