<?php

namespace App\Modules\Certificate\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'issued_date' => 'sometimes|required|date',
            'expired_date' => 'nullable|date|after_or_equal:issued_date',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
