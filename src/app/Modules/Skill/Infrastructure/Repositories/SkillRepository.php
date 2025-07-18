<?php
namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Modules\Skill\Domain\Entities\Skill;

class SkillRepository
{
    /**
     * Get all skills, ordered by the 'order' field.
     */
    public function all() {
        return Skill::orderBy('order')->get();
    }

    /**
     * Find a skill by id, throw an error if not found.
     *
     * @param int $id
     * @return Skill
     */
    public function find($id) {
        return Skill::findOrFail($id);
    }

    /**
     * Create a new skill with the provided data.
     *
     * @param array $data
     * @return Skill
     */
    public function create(array $data) {
        return Skill::create($data);
    }

    /**
     * Update a skill by id with the provided data.
     *
     * @param int $id
     * @param array $data
     * @return Skill
     */
    public function update($id, array $data) {
        $skill = $this->find($id);
        $skill->update($data);
        return $skill;
    }

    /**
     * Delete a skill by id.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id) {
        return $this->find($id)->delete();
    }
}
