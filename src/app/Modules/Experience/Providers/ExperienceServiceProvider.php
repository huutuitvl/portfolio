<?php
namespace App\Modules\Experience\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepository;
use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepositoryInterface;

class ExperienceServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Experience module.
     *
     * This method binds the Experience repository interface
     * to its concrete implementation so it can be injected
     * throughout the application.
     */
    public function register(): void
    {
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
    }

    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // You can place route, migration, or translation loading here later
        // $this->loadRoutesFrom(base_path('app/Modules/Experience/Interface/Http/routes.php'));
    }
}