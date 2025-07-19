<?php

namespace App\Modules\Skill\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillExportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            // Pagination
            'limit'      => 'sometimes|integer|min:1|max:1000',
            'offset'     => 'sometimes|integer|min:0',

            // Search Filters (only name and level allowed)
            'name'       => 'sometimes|string|max:255',
            'level'      => 'sometimes|string|max:255',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
