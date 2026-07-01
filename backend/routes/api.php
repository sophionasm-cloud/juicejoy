<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{orderNumber}', [OrderController::class, 'show']);
Route::put('/orders/{orderNumber}/status', [OrderController::class, 'updateStatus']);
Route::delete('/orders/{orderNumber}', [OrderController::class, 'destroy']);