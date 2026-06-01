<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Support\Response\ApiResponse;
use App\UseCases\Review\RateRestaurantUseCase;
use App\UseCases\Review\RateDishUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function rateRestaurant(Request $request, Restaurant $restaurant): JsonResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $useCase = new RateRestaurantUseCase();
        $review = $useCase->execute(
            $request->user(),
            $restaurant,
            $request->only(['rating', 'comment'])
        );

        return ApiResponse::created($review);
    }

    public function rateDish(Request $request, Dish $dish): JsonResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $useCase = new RateDishUseCase();
        $review = $useCase->execute(
            $request->user(),
            $dish,
            $request->only(['rating', 'comment'])
        );

        return ApiResponse::created($review);
    }
}
