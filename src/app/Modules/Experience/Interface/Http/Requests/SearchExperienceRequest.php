<?php

namespace App\Modules\Experience\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchExperienceRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ];
    }
}
