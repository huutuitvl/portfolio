<?php

namespace App\Modules\Skill\Application\Services;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepository;

class SkillService
{
    protected $repo;

    public function __construct(SkillRepository $repo)
    {
        $this->repo = $repo;
    }

    // Get all skills
    public function getAll()
    {
        return $this->repo->all();
    }

    // Get skill by ID
    public function getById($id)
    {
        return $this->repo->find($id);
    }

    // Create a new skill
    public function create($data)
    {
        return $this->repo->create($data);
    }

    // Update a skill by ID
    public function update($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    // Delete a skill by ID
    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
