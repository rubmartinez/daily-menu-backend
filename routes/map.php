<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Map\MapController;

Route::prefix('map')->group(function () {
    Route::get('/restaurants', [MapController::class, 'restaurants']);
});
