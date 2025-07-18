<?php

namespace App\Modules\Experience\Application\Services;

use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepositoryInterface;

class ExperienceService
{
    protected $repo;

    public function __construct(ExperienceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Get paginated experience list
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = 10)
    {
        return $this->repo->paginate($perPage);
    }

    /**
     * Get a single experience by ID
     *
     * @param int $id
     * @return \App\Modules\Experience\Domain\Entities\Experience
     */
    public function getById($id)
    {
        return $this->repo->findById($id);
    }

    /**
     * Create new experience
     *
     * @param array $data
     * @return \App\Modules\Experience\Domain\Entities\Experience
     */
    public function create($data)
    {
        return $this->repo->create($data);
    }

    /**
     * Update existing experience
     *
     * @param int $id
     * @param array $data
     * @return \App\Modules\Experience\Domain\Entities\Experience
     */
    public function update($id, $data)
    {
        return $this->repo->update($id, $data);
    }

    /**
     * Delete experience by ID
     *
     * @param int $id
     * @return bool|null
     */
    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
