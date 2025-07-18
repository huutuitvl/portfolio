<?php

namespace App\Modules\Profile\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Modules\Profile\Application\Services\ProfileService;
use App\Modules\Profile\Interface\Http\Requests\StoreProfileRequest;
use App\Modules\Profile\Interface\Http\Requests\UpdateProfileRequest;
use App\Modules\Profile\Interface\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function index(): \Illuminate\Http\JsonResponse
    {
        $profiles = $this->service->getAll();

        return ApiResponse::success(ProfileResource::collection($profiles));
    }

    /**
     * Handle image upload and return URL or null
     */
    protected function handleImageUpload(Request $request, $oldImage = null)
    {
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($oldImage) {
                $this->deleteImageFromUrl($oldImage);
            }

            return $request->file('image')->store('profiles', 's3');
        }

        return $oldImage;
    }

    /**
     * Delete image from S3 using its URL
     */
    protected function deleteImageFromUrl($url)
    {
        $disk = Storage::disk('s3');
        $parsed = parse_url($url);

        if (isset($parsed['path'])) {
            $key = ltrim($parsed['path'], '/');
            
            if ($disk->exists($key)) {
                $disk->delete($key);
            }
        }
    }

    /**
     * Create a new profile (Admin only)
     */
    public function store(StoreProfileRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request);

        $profile = $this->service->create($data);

        return ApiResponse::success(new ProfileResource($profile));
    }

    /**
     * Get single profile by ID
     */
    public function show($id): \Illuminate\Http\JsonResponse
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

        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $profile->image ?? null);

        $updated = $this->service->update($profile, $data);

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

        // Delete image from S3 if exists
        if ($profile->image) {
            $this->deleteImageFromUrl($profile->image);
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
