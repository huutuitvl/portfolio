<?php

namespace App\Modules\Project\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateProjectRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating contact.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         => ['sometimes', 'string', 'max:255'],
            'slug'          => ['sometimes', 'string', 'max:255'],
            'image'         => ['sometimes', 'string', 'max:255'],
            'description'   => ['sometimes', 'string'],
            'url'           => ['sometimes', 'url', 'max:255'],
            'github_url'    => ['sometimes', 'url', 'max:255'],
            'status'        => ['sometimes', 'in:draft,published'],
            'start_date'    => ['sometimes', 'date'],
            'end_date'      => ['sometimes', 'date', 'after_or_equal:start_date'],
            'completed_at'  => ['sometimes', 'date'],
            'is_featured'   => ['sometimes', 'boolean'],
            'order'         => ['sometimes', 'integer'],
            'technologies'  => ['sometimes', 'array'],
        ];
    }
}
