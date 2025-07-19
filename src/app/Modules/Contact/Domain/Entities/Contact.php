<?php

namespace App\Modules\Contact\Domain\Entities;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Contact\Database\Factories\ContactFactory;

class Contact extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'name',
        'email',
        'message',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * Specify the custom factory for the Contact model.
     */
    protected static function newFactory()
    {
        return ContactFactory::new();
    }
}
