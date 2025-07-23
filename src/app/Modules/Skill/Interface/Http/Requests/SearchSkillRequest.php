<?php

namespace App\Modules\Skill\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchSkillRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'level' => 'nullable|in:basic,intermediate,advanced,expert',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'limit' => 'sometimes|integer|min:1|max:100',
            'offset' => 'sometimes|integer|min:0',
        ];
    }
}
