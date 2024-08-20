<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductPhotoController as AdminProductPhotoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Client

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Route::resource('cart', CartController::class);
Route::controller(CartController::class)
    ->name('cart.')
    ->prefix('cart')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/', 'update')->name('update');
        Route::get('/reset', 'reset')->name('reset');
        Route::delete('/delete/{slug}', 'destroy')->name('destroy');
    });

Route::get('/help', [HomeController::class, 'help']);
Route::get('/docs', [HomeController::class, 'docs']);

// Admin

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('dashboard/index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->middleware('auth')->name('admin.')->group(function () {

    Route::resources([
        "products" => AdminProductController::class,
        "categories" => AdminCategoryController::class,
    ]);

    Route::post('/product-photos/{product}', [AdminProductPhotoController::class, 'store'])->name('products.photo.store');
    Route::delete('/product-photos/{product}', [AdminProductPhotoController::class, 'destroy'])->name('products.photo.destroy');
});


require __DIR__ . '/auth.php';
