<?php

use App\Http\Controllers\Api\OrderApiController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrderApiController::class, 'index']);
Route::get('/orders/{order}', [OrderApiController::class, 'show']);
Route::post('/orders', [OrderApiController::class, 'store']);
