<?php

namespace App\Modules\Education\Infrastructure\Repositories;

use App\Modules\Education\Domain\Entities\Education;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EducationRepository implements EducationRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Education::orderBy('order')->paginate($perPage);
    }

    public function create(array $data): Education
    {
        return Education::create($data);
    }

    public function findById(int $id): ?Education
    {
        return Education::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $education = Education::find($id);
        if (!$education) {
            return false;
        }

        return $education->update($data);
    }

    public function delete(int $id): bool
    {
        $education = Education::find($id);
        if (!$education) {
            return false;
        }

        return $education->delete();
    }
}
