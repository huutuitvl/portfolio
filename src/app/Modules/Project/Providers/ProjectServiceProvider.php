<?php

namespace App\Modules\Project\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Project\Infrastructure\Repositories\ProjectRepository;
use App\Modules\Project\Infrastructure\Repositories\ProjectRepositoryInterface;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Project module.
     *
     * This method binds the Project repository interface
     * to its concrete implementation so it can be injected
     * throughout the application.
     */
    public function register(): void
    {
        // Bind ProjectRepositoryInterface to ProjectRepository
        $this->app->bind(
            ProjectRepositoryInterface::class,
            ProjectRepository::class
        );
    }

    /**
     * Bootstrap any module services.
     *
     * This is where you can load routes, translations,
     * views, or migrations for the Project module.
     */
    public function boot(): void
    {
        // You can load routes, migrations, or translations here later
        // $this->loadRoutesFrom(base_path('app/Modules/Project/Interface/Http/routes.php'));
    }
}
