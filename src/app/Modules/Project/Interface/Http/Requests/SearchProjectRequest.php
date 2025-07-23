<?php

namespace App\Modules\Project\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProjectRequest extends FormRequest
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
            'title'        => ['nullable', 'string', 'max:255'],
            'status'       => ['nullable', 'in:draft,published'],
            'is_featured'  => ['nullable', 'boolean'],
            'start_date'   => ['nullable', 'date'],
            'end_date'     => ['nullable', 'date', 'after_or_equal:start_date'],
            'technologies' => ['nullable', 'array'], // example: ['Laravel', 'Vue']
        ];
    }
}
