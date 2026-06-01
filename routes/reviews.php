<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Review\ReviewController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/restaurants/{restaurant}/reviews', [ReviewController::class, 'rateRestaurant']);
    Route::post('/dishes/{dish}/reviews', [ReviewController::class, 'rateDish']);
});
