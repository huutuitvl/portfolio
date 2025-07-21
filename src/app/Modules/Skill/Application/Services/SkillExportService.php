<?php

namespace App\Modules\Skill\Application\Services;

use App\Exports\BaseExport;
use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;
use App\Shared\Base\BaseService;
use Maatwebsite\Excel\Facades\Excel;

class SkillExportService extends BaseService
{
    /**
     * @param SkillRepositoryInterface $repository
     */
    public function __construct(SkillRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function exportExcel($request)
    {
        $query = $this->repository->getSkills($request);
        $skills = $query->get(['name', 'level', 'icon', 'order']);

        // Transform rows
        $data = $skills->map(function ($item) {
            return [
                $item->name,
                $item->level,
                $item->icon,
                $item->order,
            ];
        })->toArray();

        $headings = ['Name', 'Level', 'Icon', 'Order'];

        return Excel::download(new BaseExport($data, $headings), 'skills_export.xlsx');
    }
}
