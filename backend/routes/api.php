<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('orders')->group(function () {
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/', [OrderController::class, 'index']);
    Route::get('/{orderNumber}', [OrderController::class, 'show']);
    Route::put('/{orderNumber}/status', [OrderController::class, 'updateStatus']);
    Route::delete('/{orderNumber}', [OrderController::class, 'destroy']);
});