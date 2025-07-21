<?php

namespace App\Modules\Skill\Application\Services;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;
use App\Shared\Base\BaseService;
use App\Modules\Skill\Interface\Http\Requests\SkillExportRequest;
use App\Shared\CsvExport;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SkillService extends BaseService
{
    public function __construct(SkillRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $filters
     * @param int $page
     * @param int $perPage
     * @param callable|null $callback
     * @return LengthAwarePaginator
     */
    public function paginateWithFilter(array $filters = [], int $page = 1, int $perPage = 10, callable $callback = null): LengthAwarePaginator
    {
        // Apply filters if any
        $conditions = [];

        if (!empty($filters['name'])) {
            $conditions[] = [
                'column' => 'name',
                'operator' => 'like',
                'value' => '%' . $filters['name'] . '%',
            ];
        }

        if (!empty($filters['level'])) {
            $conditions[] = [
                'column' => 'level',
                'operator' => 'like',
                'value' => '%' . $filters['level'] . '%',
            ];
        }

        if (!empty($filters['icon'])) {
            $conditions[] = [
                'column' => 'icon',
                'operator' => 'like',
                'value' => '%' . $filters['icon'] . '%',
            ];
        }

        if (isset($filters['order'])) {
            $conditions[] = [
                'column' => 'order',
                'operator' => '=',
                'value' => $filters['order'],
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }

    /**
     * Export filtered skills to CSV with selected columns.
     *
     * @param SkillExportRequest $request
     * @return StreamedResponse
     */
    public function exportToCsv(SkillExportRequest $request): StreamedResponse
    {
        $query = $this->repository->getSkills($request);

        // Determine which columns to export
        $allowedColumns = ['name', 'level', 'icon', 'order'];
        $requestedColumns = $request->input('columns', ['name', 'level']);
        $columnsToExport = array_values(array_intersect($requestedColumns, $allowedColumns));

        if (empty($columnsToExport)) {
            abort(422, 'No valid columns selected.');
        }

        // Headers
        $headers = array_map(fn($col) => ucfirst($col), $columnsToExport);

        // Export
        return CsvExport::downloadCsv(
            $query,
            [],
            $headers,
            'skills.csv',
            function ($row) use ($columnsToExport) {
                return array_map(fn($col) => $row[$col], $columnsToExport);
            }
        );
    }
}
