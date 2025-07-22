<?php

namespace App\Modules\Experience\Application\Services;

use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepositoryInterface;
use App\Modules\Experience\Domain\Entities\Experience;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ExperienceService extends BaseService
{
    /**
     * ExperienceService constructor.
     *
     * @param ExperienceRepositoryInterface $repo
     */
    public function __construct(ExperienceRepositoryInterface $repository)
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

        if (!empty($filters['company_name'])) {
            $conditions[] = [
                'column' => 'company_name',
                'operator' => 'like',
                'value' => '%' . $filters['company_name'] . '%',
            ];
        }

        if (!empty($filters['position'])) {
            $conditions[] = [
                'column' => 'position',
                'operator' => 'like',
                'value' => '%' . $filters['position'] . '%',
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }
}
