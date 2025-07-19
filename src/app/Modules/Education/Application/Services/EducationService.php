<?php

namespace App\Modules\Education\Application\Services;

use App\Modules\Education\Infrastructure\Repositories\EducationRepositoryInterface;
use App\Modules\Education\Domain\Entities\Education;
use App\Shared\Base\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EducationService extends BaseService
{
    protected EducationRepositoryInterface $repository;

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
     * Get a paginated list of education records.
     *
     * @param int $perPage Number of records per page.
     * @return LengthAwarePaginator Paginated list of education records.
     */
    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Create a new education record with transaction handling.
     *
     * @param array $data Data for the new education.
     * @return Education The newly created education entity.
     */
    public function create(array $data): Education
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    /**
     * Retrieve a single education record by ID.
     *
     * @param int $id The ID of the education record.
     * @return Education|null The education entity or null if not found.
     */
    public function getById(int $id): ?Education
    {
        return $this->repository->findById($id);
    }

    /**
     * Update an existing education record with transaction handling.
     *
     * @param int $id The ID of the education to update.
     * @param array $data Updated data for the education record.
     * @return bool True if update was successful, false otherwise.
     */
    public function update(int $id, array $data): bool
    {
        return $this->handleTransaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    /**
     * Soft delete an education record with transaction handling.
     *
     * @param int $id The ID of the education to delete.
     * @return bool True if deletion was successful, false otherwise.
     */
    public function delete(int $id): bool
    {
        return $this->handleTransaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }
}
