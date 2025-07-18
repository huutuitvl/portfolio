<?php
namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Modules\Skill\Domain\Entities\Skill;

class SkillRepository implements SkillRepositoryInterface
{
    /**
     * Get paginated list of skills
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 10): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Skill::orderBy('order')->paginate($perPage);
    }

    /**
     * Find a single Skill by ID
     *
     * @param int $id
     * @return Skill
     */
    public function find($id)
    {
        return Skill::findOrFail($id);
    }

    /**
     * Create a new Skill record
     *
     * @param array $data
     * @return Skill
     */
    public function create(array $data): Skill
    {
        return Skill::create($data);
    }

    /**
     * Update an existing Skill record
     *
     * @param int $id
     * @param array $data
     * @return Skill|null
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
     * Soft delete an Skill record
     *
     * @param int $id
     * @return bool
     */
    public function findById(int $id): ?Skill
    {
        return Skill::find($id);
    }

    /**
     * Delete an Skill record by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $exp = Skill::find($id);
        if (!$exp) {
            return false;
        }

        return $exp->delete();
    }
}
