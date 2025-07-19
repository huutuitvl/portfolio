<?php

namespace Modules\Skill\Application\Services;

use App\Exports\BaseExport;
use App\Modules\Skill\Domain\Entities\Skill as EntitiesSkill;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class SkillExportService
{
    public function export(array $filters = [])
    {
        $query = EntitiesSkill::query();

        // Apply filters
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['level'])) {
            $query->where('level', $filters['level']);
        }

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
