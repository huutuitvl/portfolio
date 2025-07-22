<?php

namespace App\Modules\Contact\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Contact\Domain\Entities\Contact;
use Illuminate\Database\Eloquent\Model;

class ContactRepository  extends BaseRepository implements ContactRepositoryInterface
{
    protected Model $model;

    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
}
