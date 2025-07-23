<?php
namespace App\Modules\Skill\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Skill\Domain\Entities\Skill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Skill\Interface\Http\Requests\SkillExportRequest;

class SkillRepository extends BaseRepository implements SkillRepositoryInterface
{
    protected Model $model;

    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $request
     * @return Builder
     */
    public function getSkills(SkillExportRequest $request): Builder
    {
        $query = $this->model->newQuery();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('level')) {
            $query->where('level', 'like', '%' . $request->input('level') . '%');
        }

        // Apply limit and offset
        if ($request->filled('limit')) {
            $query->limit((int)$request->input('limit'));
        }

        if ($request->filled('offset')) {
            $query->offset((int)$request->input('offset'));
        }

        return $query;
    }
}
