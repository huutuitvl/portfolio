<?php

namespace App\Modules\Certificate\Application\Services;

use App\Modules\Certificate\Infrastructure\Repositories\CertificateRepositoryInterface;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CertificateService extends BaseService
{
    public function __construct(CertificateRepositoryInterface $repository)
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

        if (!empty($filters['issuer'])) {
            $conditions[] = [
                'column' => 'issuer',
                'operator' => 'like',
                'value' => '%' . $filters['issuer'] . '%',
            ];
        }

        if (!empty($filters['credential_id'])) {
            $conditions[] = [
                'column' => 'credential_id',
                'operator' => 'like',
                'value' => '%' . $filters['credential_id'] . '%',
            ];
        }

        return $this->repository->paginateWithFilter($conditions, $page, $perPage, $callback);
    }
}
