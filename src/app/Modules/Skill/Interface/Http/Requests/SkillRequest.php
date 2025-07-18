<?php

namespace App\Modules\Skill\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'level' => 'required|in:basic,intermediate,advanced,expert',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ];
    }
}
