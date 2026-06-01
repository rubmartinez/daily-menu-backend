<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Restaurant\StoreRestaurantRequest;
use App\Http\Requests\Restaurant\UpdateRestaurantRequest;
use App\Models\Restaurant;
use App\Support\Response\ApiResponse;
use App\UseCases\Restaurant\CreateRestaurantUseCase;
use App\UseCases\Restaurant\UpdateRestaurantUseCase;
use App\UseCases\Restaurant\GetRestaurantsUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $useCase = new GetRestaurantsUseCase();
        $result = $useCase->execute($request->all());

        return ApiResponse::success($result['data'], $result['meta']);
    }

    public function show(Restaurant $restaurant): JsonResponse
    {
        $restaurant->load(['todayMenu.sections.dishes', 'reviews']);

        return ApiResponse::success($restaurant);
    }

    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        $useCase = new CreateRestaurantUseCase();
        $restaurant = $useCase->execute($request->user(), $request->validated());

        return ApiResponse::created($restaurant);
    }

    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant): JsonResponse
    {
        if ($request->user()->id !== $restaurant->owner_id) {
            return ApiResponse::forbidden();
        }

        $useCase = new UpdateRestaurantUseCase();
        $restaurant = $useCase->execute($restaurant, $request->validated());

        return ApiResponse::success($restaurant);
    }

    public function destroy(Request $request, Restaurant $restaurant): JsonResponse
    {
        if ($request->user()->id !== $restaurant->owner_id) {
            return ApiResponse::forbidden();
        }

        $restaurant->delete();

        return ApiResponse::success(['message' => 'Restaurant deleted']);
    }
}
