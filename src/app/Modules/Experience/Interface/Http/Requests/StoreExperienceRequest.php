<?php
namespace App\Modules\Experience\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreExperienceRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ];
    }
}

