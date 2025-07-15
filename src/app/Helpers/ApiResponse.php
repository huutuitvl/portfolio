<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Return a successful JSON response.
     *
     * @param mixed $data The response data.
     * @param string $message The success message.
     * @param int $status The HTTP status code.
     * @return JsonResponse
     */
    public static function success($data = null, $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message The error message.
     * @param int $status The HTTP status code.
     * @param array $errors Optional validation errors.
     * @return JsonResponse
     */
    public static function error($message = 'Error', $status = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors, // optional
        ], $status);
    }
}
