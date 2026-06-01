<?php

namespace App\UseCases\Restaurant;

use App\Models\Restaurant;

class GetRestaurantsUseCase
{
    public function execute(array $params): array
    {
        $query = Restaurant::query();

        // Geolocation filter
        if (isset($params['lat'], $params['lng'])) {
            $radius = $params['radius'] ?? 5000;
            $query->nearby((float) $params['lat'], (float) $params['lng'], (int) $radius);
        }

        // Search filter
        if (isset($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', "%{$search}%")
                  ->orWhere('address', 'ilike', "%{$search}%")
                  ->orWhere('city', 'ilike', "%{$search}%");
            });
        }

        $perPage = min((int) ($params['per_page'] ?? 20), 100);
        $paginated = $query->paginate($perPage);

        return [
            'data' => $paginated->items(),
            'meta' => [
                'page' => $paginated->currentPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
            ],
        ];
    }
}
