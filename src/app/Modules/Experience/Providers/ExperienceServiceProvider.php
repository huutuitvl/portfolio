<?php
namespace App\Modules\Experience\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepository;
use App\Modules\Experience\Infrastructure\Repositories\ExperienceRepositoryInterface;

class ExperienceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ExperienceRepositoryInterface::class, ExperienceRepository::class);
    }
}
