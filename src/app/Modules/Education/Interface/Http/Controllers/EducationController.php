<?php

namespace App\Modules\Education\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Education\Application\Services\EducationService;
use App\Modules\Education\Interface\Http\Requests\StoreEducationRequest;
use App\Modules\Education\Interface\Http\Requests\UpdateEducationRequest;

use App\Modules\Education\Interface\Http\Resources\EducationResource;
use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    protected EducationService $service;

    /**
     * EducationController constructor.
     *
     * @param EducationService $service
     */
    public function __construct(EducationService $service)
    {
        $this->middleware('auth:api');
        $this->middleware('can:isAdmin');

        $this->service = $service;
    }

    /**
     * Display a listing of the education records.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $educations = $this->service->list();

        if ($educations->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($educations, EducationResource::class)
        );
    }

    /**
     * Store a newly created education record.
     *
     * @param StoreEducationRequest $request
     * @return JsonResponse
     */
    public function store(StoreEducationRequest $request): JsonResponse
    {
        $education = $this->service->create($request->validated());

        return ApiResponse::success($education, 201);
    }

    /**
     * Display the specified education record.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $education = $this->service->getById($id);

        if (!$education) {
            return ApiResponse::error('Education not found', 404);
        }

        return ApiResponse::success($education);
    }

    /**
     * Update the specified education record.
     *
     * @param UpdateEducationRequest $request
     * @param int $id
     * @return JsonResponse
     */

    public function update(UpdateEducationRequest $request, int $id): JsonResponse
    {
        $success = $this->service->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Education not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified education record.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return ApiResponse::error('Education not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
