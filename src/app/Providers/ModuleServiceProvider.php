<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerModuleProviders();
    }

    protected function registerModuleProviders(): void
    {
        $modulePath = base_path('app/Modules');

        if (!File::isDirectory($modulePath)) {
            return;
        }

        foreach (File::directories($modulePath) as $dir) {
            $module = basename($dir);
            $providerClass = "App\\Modules\\{$module}\\Providers\\{$module}ServiceProvider";

            if (class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
        }
    }
}
