<?php

namespace App\Modules\Education\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\Education\Infrastructure\Repositories\EducationRepositoryInterface;
use App\Modules\Education\Infrastructure\Repositories\EducationRepository;

class EducationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            EducationRepositoryInterface::class,
            EducationRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
