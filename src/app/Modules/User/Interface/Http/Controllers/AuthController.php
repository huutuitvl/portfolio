<?php

namespace App\Modules\User\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Interface\Http\Requests\LoginRequest;
use App\Helpers\ApiResponse;
use App\Modules\User\Interface\Http\Resources\UserResource;

class AuthController extends Controller
{
    /**
     * Handle user login request.
     *
     * Validates user credentials and returns a JWT token if authentication is successful.
     * Responds with an error message if credentials are invalid.
     *
     * @param LoginRequest $request The login request containing user credentials.
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return ApiResponse::error('Invalid credentials', 401);
        }

        $user = auth()->user();

        if (!$user->is_active) {
            auth()->logout(); // logout ngay
            return ApiResponse::error('Account is inactive', 403);
        }

        if (is_null($user->email_verified_at)) {
            auth()->logout(); // logout ngay
            return ApiResponse::error('Email not verified', 403);
        }

        return ApiResponse::success([
            'token' => $token,
            'user' => new UserResource(auth()->user())
        ]);
    }

    /**
     * Log out the currently authenticated user.
     *
     * Invalidates the user's authentication token and returns a success message.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return ApiResponse::success(['message' => 'Logged out']);
    }

    /**
     * Get the currently authenticated user's information.
     *
     * Returns the authenticated user's details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return ApiResponse::success(auth()->user());
    }
}
