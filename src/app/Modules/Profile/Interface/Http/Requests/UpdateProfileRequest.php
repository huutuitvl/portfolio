<?php

namespace App\Modules\Profile\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

/**
 * Class UpdateProfileRequest
 * Handles validation for updating a profile.
 */
class UpdateProfileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'sometimes|string|max:255',
            'headline' => 'sometimes|nullable|string|max:255',
            'bio' => 'sometimes|nullable|string',
            'avatar' => 'sometimes|nullable|url',
            'email' => 'sometimes|nullable|email',
            'phone' => 'sometimes|nullable|string|max:20',
            'location' => 'sometimes|nullable|string|max:255',
            'birthday' => 'sometimes|nullable|date',
            'social_links' => 'sometimes|nullable|array',
        ];
    }
}
