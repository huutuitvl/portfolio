<?php

namespace App\Modules\Skill\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'title',
        'summary',
        'avatar',
        'email',
        'phone',
        'website',
        'location',
    ];
}
