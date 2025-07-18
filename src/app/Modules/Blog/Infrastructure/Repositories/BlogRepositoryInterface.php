<?php

namespace App\Modules\Blog\Infrastructure\Repositories;

use App\Modules\Blog\Domain\Entities\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BlogRepositoryInterface
{
    /**
     * Get paginated list of blog records.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    /**
     * Store a new blog record.
     */
    public function create(array $data): Blog;

    /**
     * Find a single blog record by ID.
     */
    public function findById(int $id): ?Blog;

    /**
     * Update a specific blog record.
     */
    public function update(int $id, array $data): bool;

    /**
     * Soft delete a blog record.
     */
    public function delete(int $id): bool;
}
