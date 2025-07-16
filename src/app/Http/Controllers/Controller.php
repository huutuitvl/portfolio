<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Helpers\AuthHelper;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function authorizeAdmin()
    {
        if (!AuthHelper::isAdmin()) {
            abort(response()->json([
                'status' => 403,
                'message' => 'Forbidden: Admin access only',
                'errors' => [],
            ], 403));
        }
    }

    public function authorizeEditor()
    {
        if (!AuthHelper::isEditor()) {
            abort(response()->json([
                'status' => 403,
                'message' => 'Forbidden: Editor access only',
                'errors' => [],
            ], 403));
        }
    }
}
