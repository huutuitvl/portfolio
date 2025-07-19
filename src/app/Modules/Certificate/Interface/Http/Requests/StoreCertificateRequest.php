<?php

namespace App\Modules\Certificate\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
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
            'organization' => 'nullable|string|max:255',
            'issued_date' => 'required|date',
            'expired_date' => 'nullable|date|after_or_equal:issued_date',
            'description' => 'nullable|string|max:1000',
        ];
    }
}
