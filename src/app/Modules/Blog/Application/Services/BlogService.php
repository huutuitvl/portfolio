<?php

namespace App\Modules\Blog\Application\Services;

use App\Modules\Blog\Domain\Entities\Blog;
use App\Modules\Blog\Infrastructure\Repositories\BlogRepositoryInterface;
use App\Shared\Base\BaseService;

class BlogService extends BaseService
{
    protected BlogRepositoryInterface $repository;

    public function __construct(BlogRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get paginated list of blog records.
     */
    public function list(int $perPage = 10)
    {
        return $this->repository->paginate($perPage);
    }

    /**
     * Create new blog record with transaction.
     */
    public function create(array $data): Blog
    {
        return $this->handleTransaction(function () use ($data) {
            return $this->repository->create($data);
        });
    }

    /**
     * Get blog detail by ID.
     */
    public function getById(int $id): ?Blog
    {
        return $this->repository->findById($id);
    }

    /**
     * Update existing blog record with transaction.
     */
    public function update(int $id, array $data): bool
    {
        return $this->handleTransaction(function () use ($id, $data) {
            return $this->repository->update($id, $data);
        });
    }

    /**
     * Delete blog record with transaction.
     */
    public function delete(int $id): bool
    {
        return $this->handleTransaction(function () use ($id) {
            return $this->repository->delete($id);
        });
    }
}
