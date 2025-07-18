<?php

namespace App\Modules\Skill\Providers;

use App\Modules\Skill\Infrastructure\Repositories\SkillRepository;
use App\Modules\Skill\Infrastructure\Repositories\SkillRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class SkillServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind interface to implementation
        $this->app->bind(
            SkillRepositoryInterface::class,
            SkillRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
