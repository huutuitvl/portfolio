<?php

namespace App\Modules\Skill\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Skill\Application\Services\SkillService;
use App\Modules\Skill\Interface\Http\Requests\SkillRequest;
use App\Modules\Skill\Interface\Http\Resources\SkillResource;
use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;

use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    protected SkillService $service;

    public function __construct(SkillService $service)
    {
        $this->middleware('auth:api');
        $this->middleware('can:isAdmin');
        $this->service = $service;
    }

    /**
     * Display a listing of the skills.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $skills = $this->service->paginate();

        if ($skills->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($skills, SkillResource::class)
        );
    }

    /**
     * Display the specified skill.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $skill = $this->service->getById($id);

        if (!$skill) {
            return ApiResponse::error('Skill not found', 404);
        }

        return ApiResponse::success(new SkillResource($skill));
    }

    /**
     * Store a newly created skill.
     *
     * @param SkillRequest $request
     * @return JsonResponse
     */
    public function store(SkillRequest $request): JsonResponse
    {
        $skill = $this->service->create($request->validated());

        return ApiResponse::success(new SkillResource($skill), 201);
    }

    /**
     * Update the specified skill.
     *
     * @param SkillRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SkillRequest $request, int $id): JsonResponse
    {
        $success = $this->service->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Skill not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified skill.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return ApiResponse::error('Skill not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
