<?php

namespace App\Modules\Education\Application\Services;

use App\Modules\Education\Infrastructure\Repositories\EducationRepositoryInterface;
use App\Modules\Education\Domain\Entities\Education;

class EducationService
{
    protected EducationRepositoryInterface $repository;

    public function __construct(EducationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get paginated list of education records.
     */
    public function list(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Create new education record.
     */
    public function create(array $data): Education
    {
        return $this->repository->create($data);
    }

    /**
     * Get education detail by ID.
     */
    public function getById(int $id): ?Education
    {
        return $this->repository->findById($id);
    }

    /**
     * Update existing education record.
     */
    public function update(int $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Delete education record.
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
