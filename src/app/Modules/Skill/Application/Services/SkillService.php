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
        $query->select([
            'id',
            'name',
            'level',
            'icon',
            'order',
        ]);

        // Headers
        $headers =  ['ID', 'name', 'level', 'icon', 'order'];
        // Export
        return CsvExport::downloadCsv(
            $query,
            [],
            $headers,
            CsvExport::generateCsvFilename('skills')
        );
    }
}
