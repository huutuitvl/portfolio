<?php

namespace App\Modules\Blog\Interface\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->id,
            'content' => 'required|string',
            'status' => 'in:draft,published',
            'thumbnail' => 'nullable|string',
            'published_at' => 'nullable|date',
        ];
    }
}
