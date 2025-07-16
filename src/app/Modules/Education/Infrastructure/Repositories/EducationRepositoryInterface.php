<?php

namespace App\Modules\Education\Infrastructure\Repositories;

use App\Modules\Education\Domain\Entities\Education;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EducationRepositoryInterface
{
    /**
     * Get paginated list of education records.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a new education record.
     */
    public function create(array $data): Education;

    /**
     * Find a single education record by ID.
     */
    public function findById(int $id): ?Education;

    /**
     * Update a specific education record.
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete an education record.
     */
    public function delete(int $id): bool;
}
