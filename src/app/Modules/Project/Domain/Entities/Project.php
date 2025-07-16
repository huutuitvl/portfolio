<?php

namespace App\Modules\Project\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BaseModel;

class Project extends BaseModel
{
    use HasFactory, SoftDeletes;
}
