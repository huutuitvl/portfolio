<?php

namespace App\Modules\User\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Interface\Http\Requests\LoginRequest;
use App\Helpers\ApiResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        return ApiResponse::success([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return ApiResponse::success(['message' => 'Logged out']);
    }

    public function me()
    {
        return ApiResponse::success(auth()->user());
    }
}
