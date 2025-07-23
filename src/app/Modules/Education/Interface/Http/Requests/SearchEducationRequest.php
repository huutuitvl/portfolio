<?php

namespace App\Modules\Education\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchEducationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'school_name' => 'nullable|string|max:255',
            'major'       => 'nullable|string|max:255',
            'degree'      => 'nullable|string|max:255',
        ];
    }
}
