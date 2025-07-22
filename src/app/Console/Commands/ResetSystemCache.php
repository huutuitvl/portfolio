<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetSystemCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:reset-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear Laravel caches and reset PHP OPcache';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing Laravel caches...');

        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('clear-compiled');
        $this->call('optimize:clear');
        // $this->call('opcache:clear');

        $this->info('Laravel cache cleared.');

        return Command::SUCCESS;
    }
}
