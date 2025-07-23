<?php

namespace App\Modules\Project\Application\Services;

use App\Modules\Project\Infrastructure\Repositories\ProjectRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProjectService extends BaseService
{
    /**
     * ProjectService constructor.
     *
     * @param ProjectRepositoryInterface $repository
     */
    public function __construct(ProjectRepositoryInterface $repository)
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

        if (!empty($filters['email'])) {
            $conditions[] = [
                'column' => 'email',
                'operator' => 'like',
                'value' => '%' . $filters['email'] . '%',
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }
}
