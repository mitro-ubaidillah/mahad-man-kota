<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SantriController as AdminSantriController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // If the user is authenticated, send them to the dashboard.
    // Otherwise redirect to the login page.
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// User management (only for admin/root)
Route::middleware(['auth','is_admin'])->group(function () {
    Route::post('users/check-email', [AdminUserController::class, 'checkEmail'])->name('users.check-email');
    Route::resource('users', AdminUserController::class);
});

// Santri management (for authenticated users)
Route::middleware(['auth'])->group(function () {
    // Import template download and import endpoint
    Route::get('santris/import-template', [AdminSantriController::class, 'downloadTemplate'])->name('santris.import-template');
    Route::post('santris/import', [AdminSantriController::class, 'import'])->name('santris.import');
    Route::resource('santris', AdminSantriController::class);
});
