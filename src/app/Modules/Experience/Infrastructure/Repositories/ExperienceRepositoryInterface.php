<?php

namespace App\Modules\Experience\Infrastructure\Repositories;

use App\Modules\Experience\Domain\Entities\Experience;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ExperienceRepositoryInterface
{
    /**
     * Get paginated list of experience records.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a new experience record.
     */
    public function create(array $data): Experience;

    /**
     * Find a single experience record by ID.
     */
    public function findById(int $id): ?Experience;

    /**
     * Update a specific experience record.
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete a experience record.
     */
    public function delete(int $id): bool;
}
