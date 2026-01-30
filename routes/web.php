<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorRegisterController;
use App\Http\Controllers\AdminVendorController;
use App\Http\Controllers\VendorDashboardController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorDashboardController::class, 'index'])
        ->name('vendor.dashboard');
});

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

use App\Http\Controllers\Vendor\ProductController;

Route::middleware(['auth', 'vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    // Edit & Update
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    // Delete
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


require __DIR__ . '/auth.php';