<?php

namespace App\Modules\Skill\Providers;

use App\Modules\Blog\Infrastructure\Repositories\BlogRepository;
use App\Modules\Blog\Infrastructure\Repositories\BlogRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SkillServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
