<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\AnalyticsController;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/top-revenue', [RestaurantController::class, 'topRevenue']);
    Route::get('/order/trends', [OrderController::class, 'trends']);
});
