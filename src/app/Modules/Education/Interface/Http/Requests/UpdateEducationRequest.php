<?php

namespace App\Modules\Education\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateEducationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'school_name' => 'sometimes|required|string|max:255',
            'major'       => 'nullable|string|max:255',
            'degree'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_current'  => 'boolean',
            'order'       => 'integer|min:0',
        ];
    }
}
