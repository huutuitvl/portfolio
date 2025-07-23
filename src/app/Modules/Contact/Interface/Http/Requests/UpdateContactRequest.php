<?php

namespace App\Modules\Contact\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateContactRequest extends BaseRequest
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
