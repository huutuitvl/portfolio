<?php

namespace App\Modules\Profile\Interface\Http\Controllers;

use App\Helpers\ApiResponse;

use App\Http\Controllers\Controller;
use App\Modules\Profile\Application\Services\ProfileService;
use App\Exceptions\ApiException;

class ProfileController extends Controller
{
    protected $service;

    public function __construct(ProfileService $service)
    {
        $this->service = $service;
    }

    public function show()
    {
        $profile = $this->service->getFirstProfile();

        if (!$profile) {
            throw new ApiException('Profile not found', 404);
        }

        return ApiResponse::success($profile);
    }
}
