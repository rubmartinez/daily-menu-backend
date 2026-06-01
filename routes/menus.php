<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Menu\DailyMenuController;

Route::prefix('menus')->group(function () {
    Route::get('/today', [DailyMenuController::class, 'today']);
});

Route::prefix('restaurants/{restaurant}/menu')->group(function () {
    Route::get('/today', [DailyMenuController::class, 'restaurantToday']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [DailyMenuController::class, 'store']);
        Route::put('/{menu}', [DailyMenuController::class, 'update']);
        Route::post('/{menu}/publish', [DailyMenuController::class, 'publish']);
    });
});
