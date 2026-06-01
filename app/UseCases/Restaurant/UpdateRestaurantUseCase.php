<?php

namespace App\UseCases\Restaurant;

use App\Models\Restaurant;
use App\Support\Geo\PostGISHelper;

class UpdateRestaurantUseCase
{
    public function execute(Restaurant $restaurant, array $data): Restaurant
    {
        $restaurant->update($data);

        // Update PostGIS location if coordinates changed
        if (isset($data['latitude']) || isset($data['longitude'])) {
            PostGISHelper::updateRestaurantLocation(
                $restaurant->id,
                $data['latitude'] ?? $restaurant->latitude,
                $data['longitude'] ?? $restaurant->longitude
            );
        }

        return $restaurant->fresh();
    }
}
