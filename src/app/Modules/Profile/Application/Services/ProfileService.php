<?php

namespace App\Modules\Profile\Application\Services;

use App\Modules\Profile\Domain\Entities\Profile;

class ProfileService
{
    public function getFirstProfile()
    {
        return Profile::first();
    }
}
