<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Run all module seeders automatically.
     *
     * This method scans through each module in the `app/Modules` directory,
     * finds all Seeder classes in `Database/Seeders` subdirectories,
     * and executes them using `$this->call()`.
     *
     * This approach supports modular seeding and keeps each module isolated.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class
        ]);

        // Prevent module demo/data seeders from running in production
        if (App::environment('production')) {
            $this->command->warn('Skipping module seeders in production environment.');
            return;
        }

        // Define the base modules path
        $modulePath = base_path('app/Modules');

        // Get all module directories under `app/Modules`
        $modules = File::directories($modulePath);

        foreach ($modules as $moduleDir) {
            // Define the seeder directory path inside each module
            $seederDir = $moduleDir . '/Database/Seeders';

            // Skip if the module does not have a Seeders folder
            if (!File::isDirectory($seederDir)) {
                continue;
            }

            // Get all seeder PHP files within the module
            $seederFiles = File::files($seederDir);

            foreach ($seederFiles as $file) {
                // Extract class name from filename (e.g., ProfileSeeder.php → ProfileSeeder)
                $className = pathinfo($file, PATHINFO_FILENAME);

                // Get module name from directory path
                $moduleName = basename($moduleDir);

                // Build the full namespaced seeder class
                // Example: App\Modules\Profile\Database\Seeders\ProfileSeeder
                $fullClass = "App\\Modules\\{$moduleName}\\Database\\Seeders\\{$className}";

                // Call the seeder if the class exists
                if (class_exists($fullClass)) {
                    $this->call($fullClass);
                }
            }
        }
    }
}
