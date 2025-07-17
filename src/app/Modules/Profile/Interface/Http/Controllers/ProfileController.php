<?php

namespace App\Modules\Profile\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Modules\Profile\Application\Services\ProfileService;
use App\Modules\Profile\Interface\Http\Requests\StoreProfileRequest;
use App\Modules\Profile\Interface\Http\Requests\UpdateProfileRequest;
use App\Modules\Profile\Interface\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    protected ProfileService $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;

        // Only admin can perform these actions
        $this->middleware(function ($request, $next) {
            $this->authorizeAdmin();
            return $next($request);
        })->only(['store', 'update', 'destroy']);
    }

    /**
     * Get all profiles
     */
    public function index()
    {
        $profiles = $this->service->getAll();

        return ApiResponse::success(ProfileResource::collection($profiles));
    }

    /**
     * Create a new profile (Admin only)
     */
    public function store(StoreProfileRequest $request)
    {
        $profile = $this->service->create($request->validated());

        return ApiResponse::success(new ProfileResource($profile));
    }

    /**
     * Get single profile by ID
     */
    public function show($id)
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', 404);
        }

        return ApiResponse::success(new ProfileResource($profile));
    }

    /**
     * Update profile by ID (Admin only)
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', 404);
        }

        $updated = $this->service->update($profile, $request->validated());

        return ApiResponse::success(new ProfileResource($updated));
    }

    /**
     * Delete profile (Admin only)
     */
    public function destroy($id)
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', 404);
        }

        $this->service->delete($profile);

        return ApiResponse::success(['message' => 'Profile deleted']);
    }

    /**
     * Get single profile first (Public access)
     */
    public function showPublic()
    {
        $profile = $this->service->getFirst();

        if (!$profile) {
            return ApiResponse::error('Profile not found', 404);
        }

        return ApiResponse::success(new ProfileResource($profile));
    }
}
