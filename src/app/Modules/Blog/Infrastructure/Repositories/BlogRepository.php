<?php

namespace App\Modules\Blog\Infrastructure\Repositories;


use App\Modules\Blog\Domain\Entities\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogRepository implements BlogRepositoryInterface
{
     public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Blog::orderBy('created_at')->paginate($perPage);
    }

    public function create(array $data): Blog
    {
        return Blog::create($data);
    }

    public function findById(int $id): ?Blog
    {
        return Blog::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return false;
        }

        return $blog->update($data);
    }

    public function delete(int $id): bool
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return false;
        }

        return $blog->delete();
    }

}
