<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductPhotoController as AdminProductPhotoController;

// Client

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::controller(CartController::class)
    ->name('cart.')
    ->prefix('cart')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/', 'update')->name('update');
        Route::post('/reset', 'reset')->name('reset');
        Route::delete('/delete/{slug}', 'destroy')->name('destroy');
    });

Route::get('/help', [HomeController::class, 'help']);
Route::get('/docs', [HomeController::class, 'docs']);

// Admin

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->middleware('auth')->name('admin.')->group(function () {
    
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resources([
        "products" => AdminProductController::class,
        "categories" => AdminCategoryController::class,
    ]);

    Route::controller(AdminContactController::class)
    ->name('contacts.')
    ->prefix('contact')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{contact}', 'show')->name('show');
        Route::patch('/{contact}', 'update')->name('update');
        Route::delete('/{contact}', 'destroy')->name('destroy');
    });

    # mass update
    Route::post('/update-contacts', [AdminContactController::class, 'updateMany'])->name('contacts-update-many');
    
    Route::get('/export/products', [AdminProductController::class, 'export'])->name('products.export');

    Route::post('/product-photos/{product}', [AdminProductPhotoController::class, 'store'])->name('products.photo.store');
    Route::delete('/product-photos/{product}', [AdminProductPhotoController::class, 'destroy'])->name('products.photo.destroy');

});


require __DIR__ . '/auth.php';
