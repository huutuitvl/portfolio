<?php

namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use App\Modules\Skill\Interface\Http\Requests\SkillExportRequest;

interface SkillRepositoryInterface extends BaseRepositoryInterface
{
  /**
   * @param $request
   * @return Builder
   */
  public function getSkills(SkillExportRequest $request): Builder;
}
