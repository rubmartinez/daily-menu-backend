<?php

namespace App\UseCases\Menu;

use App\Models\Menu;
use App\Models\Restaurant;

class GetTodayMenusUseCase
{
    public function execute(array $params): array
    {
        $query = Menu::with(['restaurant', 'sections.dishes'])
            ->published()
            ->today();

        // Filter by nearby restaurants
        if (isset($params['lat'], $params['lng'])) {
            $radius = $params['radius'] ?? 5000;
            $restaurantIds = Restaurant::nearby(
                (float) $params['lat'],
                (float) $params['lng'],
                (int) $radius
            )->pluck('id');

            $query->whereIn('restaurant_id', $restaurantIds);
        }

        return $query->get()->toArray();
    }
}
