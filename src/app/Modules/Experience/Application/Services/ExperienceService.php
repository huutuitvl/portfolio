<?php

namespace App\Modules\Experience\Application\Services;

use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepositoryInterface;
use App\Modules\Experience\Domain\Entities\Experience;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ExperienceService extends BaseService
{
    protected ExperienceRepositoryInterface $repo;

    /**
     * ExperienceService constructor.
     *
     * @param ExperienceRepositoryInterface $repo
     */
    public function __construct(ExperienceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get a paginated list of experience records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator Paginated result.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * Retrieve a single experience record by ID.
     *
     * @param int $id Experience ID.
     * @return Experience|null
     */
    public function getById(int $id): ?Experience
    {
        return $this->repo->findById($id);
    }

    /**
     * Create a new experience record with transaction.
     *
     * @param array $data Data for the new experience.
     * @return Experience
     */
    public function create(array $data): Experience
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->repo->create($data);
        });
    }

    /**
     * Update an existing experience record with transaction.
     *
     * @param int $id Experience ID.
     * @param array $data Updated data.
     * @return bool True if update was successful.
     */
    public function update(int $id, array $data): bool
    {
        return $this->handleTransaction(function () use ($id, $data) {
            return $this->repo->update($id, $data);
        });
    }

    /**
     * Soft delete an experience record by ID with transaction.
     *
     * @param int $id Experience ID.
     * @return bool True if deletion was successful.
     */
    public function delete(int $id): bool
    {
        return $this->handleTransaction(function () use ($id) {
            return $this->repo->delete($id);
        });
    }
}
