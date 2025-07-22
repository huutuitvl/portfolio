<?php

namespace App\Modules\Profile\Infrastructure\Repositories;

use App\Core\Repositories\Contracts\BaseRepositoryInterface;
use App\Modules\Profile\Domain\Entities\Profile;

interface ProfileRepositoryInterface extends BaseRepositoryInterface
{
    public function getFirst(): ?Profile;
}