<?php

namespace App\Modules\Blog\Infrastructure\Repositories;

use App\Modules\Blog\Domain\Entities\Blog;
use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

interface BlogRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Find a blog record by its slug.
     *
     * @param string $slug
     * @return Blog|null
     */
    public function findBySlug(string $slug): ?Blog;
}
