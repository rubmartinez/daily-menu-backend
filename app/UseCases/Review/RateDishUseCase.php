<?php

namespace App\UseCases\Review;

use App\Models\Dish;
use App\Models\DishReview;
use App\Models\User;

class RateDishUseCase
{
    public function execute(User $user, Dish $dish, array $data): DishReview
    {
        return DishReview::updateOrCreate(
            [
                'user_id' => $user->id,
                'dish_id' => $dish->id,
            ],
            [
                'rating' => $data['rating'],
                'comment' => $data['comment'] ?? null,
            ]
        );
    }
}
