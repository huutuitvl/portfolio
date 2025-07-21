<?php

namespace App\Modules\Blog\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchBlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'status' => 'nullable|integer',
            'limit' => 'sometimes|integer|min:1|max:100',
            'offset' => 'sometimes|integer|min:0',
        ];
    }
}
