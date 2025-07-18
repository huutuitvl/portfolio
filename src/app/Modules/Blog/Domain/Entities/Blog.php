<?php

namespace App\Modules\Blog\Domain\Entities;

use App\Models\BaseModel;

class Blog extends BaseModel
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'thumbnail',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
