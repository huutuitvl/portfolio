<?php

namespace App\Modules\Blog\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use App\Modules\Blog\Application\Services\BlogService;
use App\Modules\Blog\Interface\Http\Requests\SearchBlogRequest;
use App\Modules\Blog\Interface\Http\Requests\BlogRequest;
use App\Modules\Blog\Interface\Http\Resources\BlogResource;

use Illuminate\Http\JsonResponse;

/**
 * Class BlogController
 *
 * Handles HTTP requests for blog resources.
 */
class BlogController extends Controller
{
    protected BlogService $service;

    /**
     * BlogController constructor.
     *
     * @param BlogService $service The service instance for blog operations.
     */
    public function __construct(BlogService $service)
    {
        $this->middleware('auth:api');
        $this->middleware('can:isAdmin');

        $this->service = $service;
    }

    /**
     * Display a listing of blog posts with pagination.
     *
     * @return JsonResponse JSON response containing paginated blog posts.
     */
    public function index(SearchBlogRequest $request): JsonResponse
    {
        $blogs = $this->service->paginateWithFilter($request->validated(), $request->input('page', 1));

        if ($blogs->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($blogs, BlogResource::class)
        );
    }

    /**
     * Store a newly created blog post.
     *
     * @param BlogRequest $request
     * @return JsonResponse
     */
    public function store(BlogRequest $request): JsonResponse
    {
        $blog = $this->service->create($request->validated());

        return ApiResponse::success($blog, 201);
    }

    /**
     * Display the specified blog post.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $blog = $this->service->getById($id);

        if (!$blog) {
            return ApiResponse::error('Blog not found', 404);
        }

        return ApiResponse::success($blog);
    }

    /**
     * Update the specified blog post.
     *
     * @param BlogRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BlogRequest $request, int $id): JsonResponse
    {
        $success = $this->service->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Blog not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified blog post.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return ApiResponse::error('Blog not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
