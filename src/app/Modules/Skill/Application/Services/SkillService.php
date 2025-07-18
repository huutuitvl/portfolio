<?php

namespace App\Modules\Skill\Application\Services;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;

class SkillService
{
    protected $repo;

    public function __construct(SkillRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get paginated skill list
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * Get a single skill by ID
     *
     * @param int $id
     * @return \App\Modules\Skill\Domain\Entities\Skill
     */
    public function getById($id)
    {
        return $this->repo->findById($id);
    }

    /**
     * Create new skill
     *
     * @param array $data
     * @return \App\Modules\Skill\Domain\Entities\Skill
     */
    public function create($data)
    {
        return $this->repo->create($data);
    }

    /**
     * Update existing skill
     *
     * @param int $id
     * @param array $data
     * @return \App\Modules\Skill\Domain\Entities\Skill
     */
    public function update($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * Delete skill by ID
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
