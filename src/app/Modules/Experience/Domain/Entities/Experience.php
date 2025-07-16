<?php

namespace App\Modules\Experience\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends BaseModel
{
    use HasFactory, SoftDeletes;
}
