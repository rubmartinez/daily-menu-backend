<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Restaurant\RestaurantController;

Route::prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'index']);
    Route::get('/{restaurant}', [RestaurantController::class, 'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [RestaurantController::class, 'store']);
        Route::put('/{restaurant}', [RestaurantController::class, 'update']);
        Route::delete('/{restaurant}', [RestaurantController::class, 'destroy']);
    });
});
