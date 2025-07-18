<?php

namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Modules\Skill\Domain\Entities\Skill;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SkillRepositoryInterface
{
    /**
     * Get paginated list of Skill records.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a new Skill record.
     */
    public function create(array $data): Skill;

    /**
     * Find a single Skill record by ID.
     */
    public function findById(int $id): ?Skill;

    /**
     * Update a specific Skill record.
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete a Skill record.
     */
    public function delete(int $id): bool;
}
