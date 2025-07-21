<?php

namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

interface SkillRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $request
     * @return Builder
     */
    public function getSkills($request): Builder;
}
