<?php

namespace App\UseCases\Review;

use App\Models\Restaurant;
use App\Models\RestaurantReview;
use App\Models\User;

class RateRestaurantUseCase
{
    public function execute(User $user, Restaurant $restaurant, array $data): RestaurantReview
    {
        return RestaurantReview::updateOrCreate(
            [
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
            ],
            [
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ]
        );
    }
}
