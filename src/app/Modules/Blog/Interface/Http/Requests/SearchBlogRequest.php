<?php

namespace app\Modules\Blog\Interface\Http\Requests;

use App\Http\Requests\BaseRequest;

class SearchBlogRequest extends BaseRequest
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
