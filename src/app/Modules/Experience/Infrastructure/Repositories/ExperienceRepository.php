<?php

namespace App\Modules\Experience\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Experience\Domain\Entities\Experience;
use Illuminate\Database\Eloquent\Model;

class ExperienceRepository extends BaseRepository implements ExperienceRepositoryInterface
{
    protected Model $model;

    public function __construct(Experience $model)
    {
        $this->model = $model;
    }
}
