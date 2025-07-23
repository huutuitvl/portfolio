<?php

namespace App\Modules\Project\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreProjectRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating contact.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'         => ['required', 'string', 'max:255'],
            'slug'          => ['required', 'string', 'max:255', 'unique:projects,slug'],
            'image'         => ['nullable', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'url'           => ['nullable', 'url', 'max:255'],
            'github_url'    => ['nullable', 'url', 'max:255'],
            'status'        => ['nullable', 'in:draft,published'],
            'start_date'    => ['nullable', 'date'],
            'end_date'      => ['nullable', 'date', 'after_or_equal:start_date'],
            'completed_at'  => ['nullable', 'date'],
            'is_featured'   => ['nullable', 'boolean'],
            'order'         => ['nullable', 'integer'],
            'technologies'  => ['nullable', 'array'],
        ];
    }
}
