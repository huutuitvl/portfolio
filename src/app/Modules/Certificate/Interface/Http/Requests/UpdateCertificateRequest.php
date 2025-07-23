<?php

namespace App\Modules\Certificate\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class UpdateCertificateRequest extends BaseRequest
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
            'name' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'issued_date' => 'required|date',
            'expired_date' => 'required|date|after_or_equal:issued_date',
            'credential_id' => 'required|string|max:1000',
            'description' => 'required|string',
        ];
    }
}
