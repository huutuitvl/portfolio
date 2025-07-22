<?php

namespace App\Modules\Profile\Providers;

use App\Modules\Profile\Infrastructure\Repositories\ProfileRepository;
use App\Modules\Profile\Infrastructure\Repositories\ProfileRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            ProfileRepositoryInterface::class,
            ProfileRepository::class
        );
    }
}
