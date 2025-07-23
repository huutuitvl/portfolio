<?php

namespace App\Modules\Project\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Project\Domain\Entities\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectRepository  extends BaseRepository implements ProjectRepositoryInterface
{
    protected Model $model;

    public function __construct(Project $model)
    {
        parent::__construct($model);
    }
}
