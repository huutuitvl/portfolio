<?php

namespace App\Modules\Certificate\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends BaseModel
{
    use SoftDeletes;

    protected $table = 'certificates';

    protected $fillable = [
        'name',
        'issuer',
        'issued_date',
        'expiration_date',
        'credential_id',
        'credential_url',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $dates = [
        'issued_date',
        'expiration_date',
    ];
}
