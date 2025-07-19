<?php

namespace App\Modules\Contact\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:191'],
            'email' => ['sometimes', 'email'],
            'message' => ['sometimes', 'string'],
        ];
    }
}
