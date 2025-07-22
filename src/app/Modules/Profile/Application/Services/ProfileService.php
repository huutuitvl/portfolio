<?php

namespace App\Modules\Profile\Application\Services;

use App\Modules\Profile\Domain\Entities\Profile;
use App\Modules\Profile\Infrastructure\Repositories\ProfileRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProfileService extends BaseService
{
    public function __construct(ProfileRepositoryInterface $repository)
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

        if (!empty($filters['full_name'])) {
            $conditions[] = [
                'column' => 'full_name',
                'operator' => 'like',
                'value' => '%' . $filters['full_name'] . '%',
            ];
        }

        if (!empty($filters['email'])) {
            $conditions[] = [
                'column' => 'email',
                'operator' => 'like',
                'value' => '%' . $filters['email'] . '%',
            ];
        }

        if (!empty($filters['phone'])) {
            $conditions[] = [
                'column' => 'phone',
                'operator' => 'like',
                'value' => '%' . $filters['phone'] . '%',
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }

    /**
     * @return Profile|null
     */
    public function getFirst(): ?Profile
    {
        return $this->repository->getFirst();
    }
}
