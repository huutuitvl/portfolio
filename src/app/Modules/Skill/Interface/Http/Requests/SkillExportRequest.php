<?php

namespace App\Modules\Skill\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SkillExportRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'limit'  => 'nullable|integer|min:1|max:1000',
            'page'   => 'nullable|integer|min:0',
            'name'   => 'nullable|string|max:255',
            'level'  => 'nullable|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
