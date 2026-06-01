<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreDailyMenuRequest;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Support\Response\ApiResponse;
use App\UseCases\Menu\CreateDailyMenuUseCase;
use App\UseCases\Menu\PublishDailyMenuUseCase;
use App\UseCases\Menu\GetTodayMenusUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DailyMenuController extends Controller
{
    public function today(Request $request): JsonResponse
    {
        $useCase = new GetTodayMenusUseCase();
        $result = $useCase->execute($request->all());

        return ApiResponse::success($result);
    }

    public function restaurantToday(Restaurant $restaurant): JsonResponse
    {
        $menu = $restaurant->todayMenu()->with('sections.dishes')->first();

        if (!$menu) {
            return ApiResponse::notFound('No menu available today');
        }

        return ApiResponse::success($menu);
    }

    public function store(StoreDailyMenuRequest $request, Restaurant $restaurant): JsonResponse
    {
        if ($request->user()->id !== $restaurant->owner_id) {
            return ApiResponse::forbidden();
        }

        $useCase = new CreateDailyMenuUseCase();
        $menu = $useCase->execute($restaurant, $request->validated());

        return ApiResponse::created($menu->load('sections.dishes'));
    }

    public function update(Request $request, Restaurant $restaurant, Menu $menu): JsonResponse
    {
        if ($request->user()->id !== $restaurant->owner_id) {
            return ApiResponse::forbidden();
        }

        $menu->update($request->only(['title', 'description', 'price']));

        return ApiResponse::success($menu->fresh()->load('sections.dishes'));
    }

    public function publish(Request $request, Restaurant $restaurant, Menu $menu): JsonResponse
    {
        if ($request->user()->id !== $restaurant->owner_id) {
            return ApiResponse::forbidden();
        }

        $useCase = new PublishDailyMenuUseCase();
        $menu = $useCase->execute($menu);

        return ApiResponse::success($menu);
    }
}
