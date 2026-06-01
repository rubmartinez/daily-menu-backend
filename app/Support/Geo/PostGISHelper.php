<?php

namespace App\Support\Geo;

use Illuminate\Support\Facades\DB;

class PostGISHelper
{
    /**
     * Generate a raw SQL expression to create a PostGIS Point from lat/lng.
     */
    public static function makePoint(float $longitude, float $latitude): \Illuminate\Database\Query\Expression
    {
        return DB::raw("ST_MakePoint({$longitude}, {$latitude})::geography");
    }

    /**
     * Update the location column of a restaurant after insert/update.
     */
    public static function updateRestaurantLocation(int $restaurantId, float $latitude, float $longitude): void
    {
        DB::statement(
            'UPDATE restaurants SET location = ST_MakePoint(?, ?)::geography WHERE id = ?',
            [$longitude, $latitude, $restaurantId]
        );
    }
}
