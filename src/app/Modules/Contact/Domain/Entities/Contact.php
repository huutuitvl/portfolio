<?php

namespace App\Modules\Contact\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends BaseModel
{
    use HasFactory;
}
