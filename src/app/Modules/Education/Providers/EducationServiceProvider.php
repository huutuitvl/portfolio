<?php

namespace App\Modules\Education\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\Education\Infrastructure\Repositories\EducationRepositoryInterface;
use App\Modules\Education\Infrastructure\Repositories\EducationRepository;

class EducationServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Education module.
     *
     * This method binds the Education repository interface
     * to its concrete implementation so it can be injected
     * throughout the application.
     */
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            EducationRepositoryInterface::class,
            EducationRepository::class
        );
    }


    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // You can place route, migration, or translation loading here later
        // $this->loadRoutesFrom(base_path('app/Modules/Education/Interface/Http/routes.php'));
    }
}
