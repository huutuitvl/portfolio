<?php

namespace App\Modules\Project\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends BaseModel
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable (for create/update).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'url',
        'github_url',
        'status',
        'start_date',
        'end_date',
        'is_featured',
        'order',
        'technologies',
        'completed_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date'     => 'date',
        'end_date'       => 'date',
        'completed_at'   => 'date',
        'is_featured'    => 'boolean',
    ];
}
