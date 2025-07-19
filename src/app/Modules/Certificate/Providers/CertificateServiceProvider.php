<?php

namespace App\Modules\Certificate\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Certificate\Infrastructure\Repositories\CertificateRepository;
use App\Modules\Certificate\Infrastructure\Repositories\CertificateRepositoryInterface;

class CertificateServiceProvider extends ServiceProvider
{
    /**
     * Register bindings for Certificate module.
     */
    public function register(): void
    {
        // Bind Certificate repository interface to implementation
        $this->app->bind(
            CertificateRepositoryInterface::class,
            CertificateRepository::class
        );
    }

    /**
     * Bootstrap any module services.
     */
    public function boot(): void
    {
        // You can place route, migration, or translation loading here later
        // $this->loadRoutesFrom(base_path('app/Modules/Certificate/Interface/Http/routes.php'));
    }
}
