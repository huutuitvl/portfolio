<?php

namespace App\Modules\Profile\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends BaseModel
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'full_name',
        'headline',
        'bio',
        'avatar',
        'email',
        'phone',
        'location',
        'birthday',
        'social_links',
        'created_by',
    ];

    protected $casts = [
        'social_links' => 'array',
        'birthday' => 'date',
    ];
}
