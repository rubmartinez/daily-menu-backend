<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Auth routes
require __DIR__ . '/auth.php';

// Restaurant routes
require __DIR__ . '/restaurants.php';

// Menu routes
require __DIR__ . '/menus.php';

// Map routes
require __DIR__ . '/map.php';

// Review routes
require __DIR__ . '/reviews.php';

