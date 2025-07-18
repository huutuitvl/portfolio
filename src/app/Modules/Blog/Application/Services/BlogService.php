<?php

namespace App\Modules\Blog\Application\Services;

use App\Modules\Blog\Domain\Entities\Blog;
use App\Modules\Blog\Infrastructure\Repositories\BlogRepositoryInterface;

class BlogService
{
    protected BlogRepositoryInterface $repository;

    public function __construct(BlogRepositoryInterface $repository)
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
     * Create new blog record.
     */
    public function create(array $data): Blog
    {
        return $this->repository->create($data);
    }

    /**
     * Get blog detail by ID.
     */
    public function getById(int $id): ?Blog
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
