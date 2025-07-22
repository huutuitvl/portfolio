<?php

namespace App\Modules\Profile\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * Class SearchProfileRequest
 * Handles validation for storing a new profile.
 */
class SearchProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'nullable|string|max:255',
            'headline' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20'
        ];
    }
}
