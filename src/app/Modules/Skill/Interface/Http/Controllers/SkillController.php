<?php

namespace App\Modules\Skill\Interface\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Skill\Application\Services\SkillService;
use App\Modules\Skill\Interface\Http\Requests\SkillRequest;
use App\Modules\Skill\Interface\Http\Resources\SkillResource;

use App\Helpers\ApiResponse;
use App\Helpers\PaginatorHelper;
use App\Modules\Skill\Domain\Entities\Skill;
use App\Modules\Skill\Infrastructure\Http\Requests\SkillExportRequest;
use App\Shared\Helpers\ResponseHelper;
use App\Shared\Services\CsvImport;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Skill\Application\Services\SkillExportService;

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

    /**
     * Export skill data as a CSV file with dynamic filtering and selected columns.
     *
     * This function retrieves skill records with optional filters (e.g., name, level),
     * allows selecting which columns to export, and supports pagination (limit & offset).
     *
     * @param  SkillExportRequest $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function export(SkillExportRequest $request)
    {
        return $this->service->exportToCsv($request);
    }


    /**
     * Import skills from a CSV file using batch processing and validation.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        $result = CsvImport::importCsv(
            $request->file('csv'),
            [
                'Name'  => 'required|string|max:255',   // Skill name
                'Level' => 'required|string|max:255',   // Skill level
                'Icon'  => 'required|integer|min:1|max:5', // Icon
                'Order' => 'nullable|string|max:255',   // Order
            ],
            function (array $batch) {
                $rows = [];

                foreach ($batch as $row) {
                    $rows[] = [
                        'name'        => $row['Name'],
                        'level'       => $row['Level'],
                        'icon'        => $row['Icon'],
                        'order'       => $row['Order'],
                        'created_by'  => Auth::id(),
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }

                // Use bulk insert for better performance
                Skill::insert($rows);
            },
            100 // Batch size
        );

        // Return a standardized JSON response for the import result
        return ResponseHelper::jsonImportResponse('Import completed.', $result);
    }

    /**
     * Export skills to an Excel file.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportExcel(Request $request)
    {
        return app(SkillExportService::class)->export($request->only(['name', 'level']));
    }
}
