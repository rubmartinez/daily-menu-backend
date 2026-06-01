<?php

namespace App\UseCases\Map;

use App\Models\Restaurant;

class GetMapRestaurantsUseCase
{
    public function execute(float $lat, float $lng, int $radiusMeters): array
    {
        $restaurants = Restaurant::nearby($lat, $lng, $radiusMeters)
            ->with('todayMenu')
            ->get()
            ->map(function ($restaurant) {
                return [
                    'id' => $restaurant->id,
                    'name' => $restaurant->name,
                    'latitude' => $restaurant->latitude,
                    'longitude' => $restaurant->longitude,
                    'address' => $restaurant->address,
                    'has_menu_today' => $restaurant->todayMenu !== null,
                    'menu_price' => $restaurant->todayMenu?->price,
                    'menu_title' => $restaurant->todayMenu?->title,
                ];
            })
            ->toArray();

        return $restaurants;
    }
}
