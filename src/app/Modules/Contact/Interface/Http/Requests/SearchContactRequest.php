<?php

namespace App\Modules\Contact\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchContactRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:191'],
            'email' => ['nullable', 'email'],
            'message' => ['nullable', 'string'],
        ];
    }
}
