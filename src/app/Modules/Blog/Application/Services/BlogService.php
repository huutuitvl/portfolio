<?php

namespace App\Modules\Blog\Application\Services;

use App\Modules\Blog\Infrastructure\Repositories\BlogRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogService extends BaseService
{
    public function __construct(BlogRepositoryInterface $repository)
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

        if (!empty($filters['title'])) {
            $conditions[] = [
                'column' => 'title',
                'operator' => 'like',
                'value' => '%' . $filters['title'] . '%',
            ];
        }

        if (!empty($filters['slug'])) {
            $conditions[] = [
                'column' => 'slug',
                'operator' => 'like',
                'value' => '%' . $filters['level'] . '%',
            ];
        }

        if (!empty($filters['content'])) {
            $conditions[] = [
                'column' => 'content',
                'operator' => 'like',
                'value' => '%' . $filters['content'] . '%',
            ];
        }

        if (isset($filters['status'])) {
            $conditions[] = [
                'column' => 'status',
                'operator' => '=',
                'value' => $filters['status'],
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }
}
