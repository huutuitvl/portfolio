<?php

namespace App\Modules\Education\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'education';

    protected $fillable = [
        'school_name',
        'major',
        'degree',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_current' => 'boolean',
    ];
}
