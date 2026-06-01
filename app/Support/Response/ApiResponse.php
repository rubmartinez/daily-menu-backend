<?php

namespace App\Support\Response;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, $meta = null, int $status = 200): JsonResponse
    {
        $response = [
            'data' => $data,
            'error' => null,
        ];

        if ($meta !== null) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }

    public static function created($data = null): JsonResponse
    {
        return self::success($data, null, 201);
    }

    public static function error(string $code, string $message, $fields = null, int $status = 400): JsonResponse
    {
        $error = [
            'code' => $code,
            'message' => $message,
        ];

        if ($fields !== null) {
            $error['fields'] = $fields;
        }

        return response()->json([
            'data' => null,
            'error' => $error,
        ], $status);
    }

    public static function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return self::error('NOT_FOUND', $message, null, 404);
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error('UNAUTHORIZED', $message, null, 401);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error('FORBIDDEN', $message, null, 403);
    }

    public static function validationError($fields): JsonResponse
    {
        return self::error('VALIDATION_ERROR', 'Invalid input', $fields, 422);
    }
}
