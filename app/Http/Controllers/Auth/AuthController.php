<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Support\Response\ApiResponse;
use App\UseCases\Auth\RegisterUserUseCase;
use App\UseCases\Auth\LoginUserUseCase;
use App\UseCases\Auth\GetMeUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $useCase = new RegisterUserUseCase();
        $result = $useCase->execute($request->validated());

        return ApiResponse::created($result);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $useCase = new LoginUserUseCase();
        $result = $useCase->execute($request->validated());

        if (!$result) {
            return ApiResponse::unauthorized('Invalid credentials');
        }

        return ApiResponse::success($result);
    }

    public function me(Request $request): JsonResponse
    {
        $useCase = new GetMeUseCase();
        $result = $useCase->execute($request->user());

        return ApiResponse::success($result);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return ApiResponse::success(['message' => 'Logged out']);
    }
}
