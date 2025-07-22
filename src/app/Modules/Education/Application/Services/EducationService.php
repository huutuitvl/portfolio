<?php

namespace App\Modules\Education\Application\Services;

use App\Modules\Education\Infrastructure\Repositories\EducationRepositoryInterface;
use App\Modules\Education\Domain\Entities\Education;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EducationService extends BaseService 
{
    /**
     * EducationService constructor.
     *
     * @param EducationRepositoryInterface $repository
     */
    public function __construct(EducationRepositoryInterface $repository)
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
