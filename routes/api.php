<?php

use App\Http\Controllers\Api\OrderSyncController;
use App\Http\Controllers\Api\ProductSyncController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('sync')->middleware('sync.api')->group(function () {
    Route::get('/products', [ProductSyncController::class, 'index']);
    Route::get('/products/{product}', [ProductSyncController::class, 'show']);

    Route::get('/orders', [OrderSyncController::class, 'index']);
    Route::get('/orders/{order}', [OrderSyncController::class, 'show']);
});
