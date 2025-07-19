<?php

namespace App\Modules\Skill\Application\Services;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;
use App\Shared\Base\BaseService;
use App\Modules\Skill\Domain\Entities\Skill;
use App\Shared\Services\CsvExport;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SkillService extends BaseService
{
    protected SkillRepositoryInterface $repo;

    public function __construct(SkillRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get paginated list of skills.
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * Get a skill by ID.
     *
     * @param int $id
     * @return Skill|null
     */
    public function getById(int $id): ?Skill
    {
        return $this->repo->findById($id);
    }

    /**
     * Create a new skill with transaction.
     *
     * @param array $data
     * @return Skill
     */
    public function create(array $data): Skill
    {
        return $this->handleTransaction(function () use ($data) {
            $data['created_by'] = auth()->id();
            return $this->repo->create($data);
        });
    }

    /**
     * Update an existing skill with transaction.
     *
     * @param int $id
     * @param array $data
     * @return Skill
     */
    public function update(int $id, array $data): Skill
    {
        return $this->handleTransaction(function () use ($id, $data) {
            $data['updated_by'] = auth()->id();
            return $this->repo->update($id, $data);
        });
    }

    /**
     * Delete a skill by ID with transaction.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        return $this->handleTransaction(function () use ($id) {
            return $this->repo->delete($id);
        });
    }

    /**
     * Export filtered skills to CSV with selected columns.
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportToCsv(Request $request): StreamedResponse
    {
        $query = Skill::query();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('level')) {
            $query->where('level', 'like', '%' . $request->input('level') . '%');
        }

        // Apply limit and offset
        if ($request->filled('limit')) {
            $query->limit((int)$request->input('limit'));
        }

        if ($request->filled('offset')) {
            $query->offset((int)$request->input('offset'));
        }

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
