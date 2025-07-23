<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $modulesPath = base_path('app/Modules');

        // Ensure the modules directory exists
        if (!File::isDirectory($modulesPath)) {
            return;
        }

        // Loop through all module directories
        foreach (File::directories($modulesPath) as $moduleDir) {
            // Extract module name (e.g., Profile, Blog)
            $moduleName = basename($moduleDir);

            // Build the migration path for this module
            $migrationPath = $moduleDir . '/Database/Migrations';

            // If the migration directory exists, load it
            if (File::isDirectory($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
            }
        }
    }
}
