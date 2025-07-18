<?php

namespace App\Modules\Skill\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Skill extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'level',
        'icon',
        'order',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
