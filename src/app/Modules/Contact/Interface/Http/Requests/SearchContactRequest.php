<?php

namespace App\Modules\Contact\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchContactRequest extends BaseRequest
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
