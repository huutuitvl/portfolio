<?php

namespace App\Modules\Contact\Application\Services;

use App\Modules\Contact\Infrastructure\Repositories\ContactRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactService extends BaseService
{
    /**
     * ContactService constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $repository)
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
