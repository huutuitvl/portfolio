<?php

namespace App\Modules\Certificate\Infrastructure\Repositories;

use App\Core\Repositories\Eloquent\BaseRepository;
use App\Modules\Certificate\Domain\Entities\Certificate;
use Illuminate\Database\Eloquent\Model;

class CertificateRepository extends BaseRepository implements CertificateRepositoryInterface
{
    protected Model $model;

    public function __construct(Certificate $model)
    {
        $this->model = $model;
    }
}
