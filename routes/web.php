<?php

use App\Http\Controllers\CarrierController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/orders-export-csv', [OrderController::class, 'exportCsv'])
    ->name('orders.export');

Route::resource('orders', OrderController::class);
Route::resource('carriers', CarrierController::class);