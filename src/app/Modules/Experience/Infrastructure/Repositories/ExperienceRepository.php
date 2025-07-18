<?php
namespace App\Modules\Experience\Infrastructure\Repositories;

use App\Modules\Experience\Domain\Entities\Experience;

class ExperienceRepository implements ExperienceRepositoryInterface
{
    /**
     * Get paginated list of experiences
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Experience::orderBy('order')->paginate($perPage);
    }

    /**
     * Find a single experience by ID
     *
     * @param int $id
     * @return Experience
     */
    public function find($id)
    {
        return Experience::findOrFail($id);
    }

    /**
     * Create a new experience record
     *
     * @param array $data
     * @return Experience
     */
    public function create(array $data): Experience
    {
        return Experience::create($data);
    }

    /**
     * Update an existing experience record
     *
     * @param int $id
     * @param array $data
     * @return Experience|null
     */
    public function update(int $id, array $data): bool
    {
        $exp = $this->find($id);
        if (!$exp) {
            return false;
        }

        return $exp->update($data);
    }
    /**
     * Soft delete an experience record
     *
     * @param int $id
     * @return bool
     */
    public function findById(int $id): ?Experience
    {
        return Experience::find($id);
    }

    /**
     * Delete an experience record by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $exp = Experience::find($id);
        if (!$exp) {
            return false;
        }

        return $exp->delete();
    }
}
