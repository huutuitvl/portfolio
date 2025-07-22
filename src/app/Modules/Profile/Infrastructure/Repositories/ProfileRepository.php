<?php

namespace App\Modules\Profile\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Profile\Domain\Entities\Profile;
use Illuminate\Database\Eloquent\Model;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    protected Model $model;

    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    /**
     * Get first profile
     */
    public function getFirst(): ?Profile
    {
        return $this->model->first();
    }
}
