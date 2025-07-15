<?php

namespace App\Modules\Profile\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

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
