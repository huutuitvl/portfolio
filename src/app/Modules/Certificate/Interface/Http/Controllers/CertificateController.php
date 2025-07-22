<?php

namespace App\Modules\Certificate\Interface\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\Controller;
use App\Modules\Certificate\Application\Services\CertificateService;
use App\Modules\Certificate\Interface\Http\Requests\SearchCertificateRequest;
use App\Modules\Certificate\Interface\Http\Requests\StoreCertificateRequest;
use App\Modules\Certificate\Interface\Http\Requests\UpdateCertificateRequest;
use App\Modules\Certificate\Interface\Http\Resources\CertificateResource;
use Illuminate\Http\JsonResponse;

/**
 * Class CertificateController
 *
 * Handles HTTP requests for certificate resources.
 */
class CertificateController extends Controller
{
    protected CertificateService $service;

    /**
     * CertificateController constructor.
     *
     * @param CertificateService $service The service instance for certificate operations.
     */
    public function __construct(CertificateService $service)
    {
        $this->middleware('auth:api');
        $this->middleware('can:isAdmin');

        $this->service = $service;
    }

    /**
     * Display a listing of certificate records with pagination.
     *
     * @return JsonResponse JSON response containing paginated certificates.
     */
    public function index(SearchCertificateRequest $request): JsonResponse
    {
        $certificate = $this->service->paginateWithFilter($request->validated(), $request->input('page', 1));

        if ($certificate->isEmpty()) {
            return ApiResponse::success([], 204);
        }

        return ApiResponse::success(
            PaginatorHelper::format($certificate, CertificateResource::class)
        );
    }

    /**
     * Store a newly created certificate.
     *
     * @param StoreCertificateRequest $request
     * @return JsonResponse
     */
    public function store(StoreCertificateRequest $request): JsonResponse
    {
        $certificate = $this->service->create($request->validated());

        return ApiResponse::success($certificate, 201);
    }

    /**
     * Display the specified certificate.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $certificate = $this->service->getById($id);

        if (!$certificate) {
            return ApiResponse::error('Certificate not found', 404);
        }

        return ApiResponse::success($certificate);
    }

    /**
     * Update the specified certificate.
     *
     * @param UpdateCertificateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCertificateRequest $request, int $id): JsonResponse
    {
        $success = $this->service->update($id, $request->validated());

        if (!$success) {
            return ApiResponse::error('Certificate not found', 404);
        }

        return ApiResponse::success(['message' => 'Updated successfully']);
    }

    /**
     * Remove the specified certificate.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->delete($id);

        if (!$success) {
            return ApiResponse::error('Certificate not found', 404);
        }

        return ApiResponse::success(['message' => 'Deleted successfully']);
    }
}
