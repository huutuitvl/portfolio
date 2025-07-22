<?php

namespace App\Modules\Education\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Education\Domain\Entities\Education;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class EducationRepository extends BaseRepository implements EducationRepositoryInterface
{
    protected Model $model;

    public function __construct(Education $model)
    {
        parent::__construct($model);
    }
}
