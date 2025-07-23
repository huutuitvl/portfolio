<?php

namespace App\Modules\Blog\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class BlogRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,',
            'content' => 'required|string',
            'status' => 'in:draft,published',
            'thumbnail' => 'nullable|string',
            'published_at' => 'nullable|date',
        ];
    }
}
