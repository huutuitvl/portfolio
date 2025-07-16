<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthHelper
{
    /**
     * Get current user ID.
     */
    public static function getCurrentUserId(): ?int
    {
        return Auth::id();
    }

    /**
     * Get current user model.
     */
    public static function user()
    {
        return Auth::user();
    }

    /**
     * Check if current user is admin.
     */
    public static function isAdmin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }

    /**
     * Check if current user is editor.
     */
    public static function isEditor(): bool
    {
        return Auth::check() && Auth::user()->role === 'editor';
    }
}
