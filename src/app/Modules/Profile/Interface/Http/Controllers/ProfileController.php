<?php

namespace App\Modules\Profile\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use App\Modules\Profile\Application\Services\ProfileService;
use App\Modules\Profile\Interface\Http\Requests\SearchProfileRequest;
use App\Modules\Profile\Interface\Http\Requests\StoreProfileRequest;
use App\Modules\Profile\Interface\Http\Requests\UpdateProfileRequest;
use App\Modules\Profile\Interface\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
     *
     * @param SearchProfileRequest $request
     * @return JsonResponse
     */
    public function index(SearchProfileRequest $request): JsonResponse
    {
        $profiles = $this->service->paginateWithFilter($request->validated(), $request->input('page', 1));

        if ($profiles->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($profiles, ProfileResource::class)
        );
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
    public function store(StoreProfileRequest $request): jsonResponse
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request);

        $profile = $this->service->create($data);

        return ApiResponse::success(new ProfileResource($profile));
    }

    /**
     * Get single profile by ID
     */
    public function show($id): JsonResponse
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', Response::HTTP_NOT_FOUND);
        }

        return ApiResponse::success(new ProfileResource($profile));
    }

    /**
     * @param UpdateProfileRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request, $id): JsonResponse
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', Response::HTTP_NOT_FOUND);
        }

        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $profile->image ?? null);

        $updated = $this->service->update($id, $data);

        return ApiResponse::success(new ProfileResource($updated));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $profile = $this->service->getById($id);

        if (!$profile) {
            return ApiResponse::error('Profile not found', Response::HTTP_NOT_FOUND);
        }

        // Delete image from S3 if exists
        if ($profile->image) {
            $this->deleteImageFromUrl($profile->image);
        }

        $this->service->delete($id);

        return ApiResponse::success(['message' => 'Profile deleted']);
    }


    /**
     * @return JsonResponse
     */
    public function showPublic(): JsonResponse
    {
        $profile = $this->service->getFirst();

        if (!$profile) {
            return ApiResponse::error('Profile not found', Response::HTTP_NOT_FOUND);
        }

        return ApiResponse::success(new ProfileResource($profile));
    }
}
