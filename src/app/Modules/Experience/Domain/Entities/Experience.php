<?php

namespace App\Modules\Experience\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'experiences';

    protected $fillable = [
        'company',
        'position',
        'description',
        'start_date',
        'end_date',
        'is_current',
        'order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
