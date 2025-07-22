<?php

namespace App\Modules\Experience\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchExperienceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ];
    }
}
