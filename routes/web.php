<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, "index"])->name("home");
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::middleware("auth")->group(function () {
    Route::resource('cart', CartController::class);
    Route::get("/checkout", [CartController::class, 'checkout'])->name("checkout");
    Route::resource("orders", OrderController::class);
    Route::resource("wishlist", WishlistController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';