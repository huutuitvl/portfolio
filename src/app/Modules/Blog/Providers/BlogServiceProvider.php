<?php

namespace App\Modules\Blog\Providers;

use App\Modules\Blog\Infrastructure\Repositories\BlogRepository;
use App\Modules\Blog\Infrastructure\Repositories\BlogRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
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
