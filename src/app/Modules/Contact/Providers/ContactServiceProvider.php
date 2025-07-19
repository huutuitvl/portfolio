<?php

namespace App\Modules\Contact\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Contact\Infrastructure\Repositories\ContactRepository;
use App\Modules\Contact\Infrastructure\Repositories\ContactRepositoryInterface;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Contact module.
     *
     * This method binds the Contact repository interface
     * to its concrete implementation so it can be injected
     * throughout the application.
     */
    public function register(): void
    {
        // Bind ContactRepositoryInterface to ContactRepository
        $this->app->bind(
            ContactRepositoryInterface::class,
            ContactRepository::class
        );
    }

    /**
     * Bootstrap any module services.
     *
     * This is where you can load routes, translations,
     * views, or migrations for the Contact module.
     */
    public function boot(): void
    {
        // You can load routes, migrations, or translations here later
        // $this->loadRoutesFrom(base_path('app/Modules/Contact/Interface/Http/routes.php'));
    }
}
