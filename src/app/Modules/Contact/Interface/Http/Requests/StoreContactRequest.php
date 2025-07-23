<?php

namespace App\Modules\Contact\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class StoreContactRequest extends BaseRequest
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
        ];
    }
}
