<?php

namespace App\Modules\Skill\Providers;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepository;
use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SkillServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Skill module.
     *
     * This method binds the Skill repository interface
     * to its concrete implementation so it can be injected
     * throughout the application.
     */
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            SkillRepositoryInterface::class,
            SkillRepository::class
        );
    }


    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // You can place route, migration, or translation loading here later
        // $this->loadRoutesFrom(base_path('app/Modules/Skill/Interface/Http/routes.php'));
    }
}
