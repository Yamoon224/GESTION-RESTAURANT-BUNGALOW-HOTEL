<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;

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

// Route::get('/', [Controller::class, 'welcome'])->name('welcome');


Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');

    // The Resource Controller -all
    Route::middleware('admin')->group(function() {
        Route::resource('categories', CategoryController::class);
    });
    
    Route::resource('products', ProductController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('users', UserController::class);

    // The PDF Resource
    Route::get('/orders/{id}/{type}', [PdfController::class, 'receipt'])->name('orders.receipt');
    Route::post('/orders/dailyreport', [PdfController::class, 'dailyreport'])->name('orders.dailyreport');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 


require __DIR__.'/auth.php';
