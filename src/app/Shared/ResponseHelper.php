<?php

namespace App\Shared\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Generate standardized JSON response for CSV import result.
     *
     * @param string $message
     * @param array $result
     * @return JsonResponse
     */
    public static function jsonImportResponse(string $message, array $result): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'success' => $result['success_count'] ?? 0,
            'failed' => $result['error_count'] ?? 0,
            'errors' => $result['errors'] ?? [],
        ]);
    }
}
