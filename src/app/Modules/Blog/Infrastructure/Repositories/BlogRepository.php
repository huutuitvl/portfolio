<?php

namespace App\Modules\Blog\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Blog\Domain\Entities\Blog;
use Illuminate\Database\Eloquent\Model;
class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    protected Model $model;

    public function __construct(Blog $model)
    {
        parent::__construct($model);
    }

    /**
     * Find a blog record by its slug.
     *
     * @param string $slug
     * @return Blog|null
     */
    public function findBySlug(string $slug): ?Blog
    {
        return $this->model->where('slug', $slug)->first();
    }
}
