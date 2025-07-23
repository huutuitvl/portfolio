<?php

namespace App\Modules\Project\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Modules\Project\Application\Services\ProjectService;
use App\Modules\Project\Interface\Http\Requests\SearchProjectRequest;
use App\Modules\Project\Interface\Http\Requests\StoreProjectRequest;
use App\Modules\Project\Interface\Http\Requests\UpdateProjectRequest;
use App\Modules\Project\Interface\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    /**
     * ProjectController constructor.
     *
     * @param ProjectService $projectService
     */
    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Get paginated list of Projects.
     *
     * @return JsonResponse
     */
    public function index(SearchProjectRequest $request): JsonResponse
    {
        $Projects = $this->projectService->paginateWithFilter($request->validated(), $request->input('page', 1));

        if ($Projects->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($Projects, ProjectResource::class)
        );
    }

    /**
     * Store a newly created Project.
     *
     * @param StoreProjectRequest $request
     * @return JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        $Project = $this->projectService->create($request->validated());

        return  ApiResponse::success($Project, Response::HTTP_CREATED);
    }

    /**
     * Get a single Project by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $Project = $this->projectService->getById($id);

        if (!$Project) {
            return ApiResponse::error('Project not found', 404);
        }

        return ApiResponse::success($Project);
    }

    /**
     * Update a specific Project.
     *
     * @param UpdateProjectRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, int $id): JsonResponse
    {
        $success = $this->projectService->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Project not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Delete a Project.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->projectService->delete($id);

        if (!$success) {
            return ApiResponse::error('Project not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
