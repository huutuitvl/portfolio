<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerModuleProviders();
    }

    protected function registerModuleProviders(): void
    {
        $modules = [
            'Education',
            'Profile',
            'User',
            'Blog',
            'Skill',
            'Contact',
            'Project',
            'Experience',
            'Certificate',
        ];

        foreach ($modules as $module) {
            $providerPath = "App\\Modules\\$module\\Providers\\{$module}ServiceProvider";

            if (class_exists($providerPath)) {
                $this->app->register($providerPath);
            }
        }
    }
}
