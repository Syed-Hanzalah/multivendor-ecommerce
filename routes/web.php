<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorRegisterController;
use App\Http\Controllers\AdminVendorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/vendor/register', [VendorRegisterController::class, 'create'])
    ->name('vendor.register');

Route::post('/vendor/register', [VendorRegisterController::class, 'store'])
    ->name('vendor.register.store');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/vendors', [AdminVendorController::class, 'index'])->name('admin.vendors');
    Route::post('/admin/vendors/{user}/approve', [AdminVendorController::class, 'approve'])->name('admin.vendors.approve');
});


require __DIR__ . '/auth.php';