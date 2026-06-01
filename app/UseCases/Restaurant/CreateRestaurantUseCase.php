<?php

namespace App\UseCases\Restaurant;

use App\Models\Restaurant;
use App\Models\User;
use App\Support\Geo\PostGISHelper;
use Illuminate\Support\Str;

class CreateRestaurantUseCase
{
    public function execute(User $owner, array $data): Restaurant
    {
        $restaurant = Restaurant::create([
            'owner_id' => $owner->id,
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(5),
            'description' => $data['description'] ?? null,
            'address' => $data['address'],
            'city' => $data['city'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'phone' => $data['phone'] ?? null,
            'email' => $data['email'] ?? null,
            'website' => $data['website'] ?? null,
        ]);

        // Update PostGIS location column
        PostGISHelper::updateRestaurantLocation(
            $restaurant->id,
            $data['latitude'],
            $data['longitude']
        );

        return $restaurant->fresh();
    }
}
