<?php

namespace App\Modules\Contact\Infrastructure\Repositories;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use App\Core\Repositories\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ContactRepository  extends BaseRepository implements ContactRepositoryInterface
{
    protected Model $model;

    public function __construct(ContactRepository $model)
    {
        parent::__construct($model);
    }
}
