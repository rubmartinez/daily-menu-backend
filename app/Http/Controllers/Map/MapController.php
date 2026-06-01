<?php

namespace App\Http\Controllers\Map;

use App\Http\Controllers\Controller;
use App\Support\Response\ApiResponse;
use App\UseCases\Map\GetMapRestaurantsUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function restaurants(Request $request): JsonResponse
    {
        $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
            'radius' => ['sometimes', 'integer', 'min:100', 'max:50000'],
        ]);

        $useCase = new GetMapRestaurantsUseCase();
        $result = $useCase->execute(
            (float) $request->lat,
            (float) $request->lng,
            (int) ($request->radius ?? 5000)
        );

        return ApiResponse::success($result);
    }
}
