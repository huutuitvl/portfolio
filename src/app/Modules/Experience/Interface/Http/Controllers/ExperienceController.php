<?php

namespace App\Modules\Experience\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Experience\Application\Services\ExperienceService;
use App\Modules\Experience\Interface\Http\Requests\StoreExperienceRequest;
use App\Modules\Experience\Interface\Http\Requests\UpdateExperienceRequest;
use App\Modules\Experience\Interface\Http\Resources\ExperienceResource;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Modules\Experience\Interface\Http\Requests\SearchExperienceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class ExperienceController
 *
 * Handles API requests for experience management.
 */
class ExperienceController extends Controller
{
    protected ExperienceService $service;

    /**
     * ExperienceController constructor.
     *
     * @param ExperienceService $service The experience service class.
     */
    public function __construct(ExperienceService $service)
    {
        $this->middleware('auth:api');
        $this->middleware('can:isAdmin');

        $this->service = $service;
    }

    /**
     * Get a paginated list of experience records.
     *
     * @return JsonResponse
     */
    public function index(SearchExperienceRequest $request): JsonResponse
    {
        $experiences = $this->service->paginateWithFilter($request->validated(), $request->input('page', 1));
        if ($experiences->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($experiences, ExperienceResource::class)
        );
    }

    /**
     * Store a new experience record.
     *
     * @param StoreExperienceRequest $request
     * @return JsonResponse
     */
    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $experience = $this->service->create($request->validated());

        return ApiResponse::success($experience, 201);
    }

    /**
     * Get a single experience record by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $experience = $this->service->getById($id);

        if (!$experience) {
            return ApiResponse::error('Experience not found', Response::HTTP_NOT_FOUND);
        }

        return ApiResponse::success($experience);
    }

    /**
     * Update an existing experience record.
     *
     * @param UpdateExperienceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateExperienceRequest $request, int $id): JsonResponse
    {
        $success = $this->service->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Experience not found', Response::HTTP_NOT_FOUND);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Delete an experience record by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return ApiResponse::error('Experience not found', Response::HTTP_NOT_FOUND);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
