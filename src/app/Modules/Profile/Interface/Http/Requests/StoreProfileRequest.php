<?php

namespace App\Modules\Profile\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * Class StoreProfileRequest
 * Handles validation for storing a new profile.
 */
class StoreProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'social_links' => 'nullable|array',
        ];
    }
}

