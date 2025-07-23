<?php

namespace App\Modules\Certificate\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchCertificateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'credential_id' => 'nullable|string|max:1000'
        ];
    }
}
