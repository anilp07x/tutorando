<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CacheService;

class ClearAppCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all application caches including model and dashboard caches';

    /**
     * The cache service instance.
     *
     * @var \App\Services\CacheService
     */
    protected $cacheService;

    /**
     * Create a new command instance.
     *
     * @param  \App\Services\CacheService  $cacheService
     * @return void
     */
    public function __construct(CacheService $cacheService)
    {
        parent::__construct();
        $this->cacheService = $cacheService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Clearing application caches...');
        
        $this->cacheService->clearAllCaches();
        
        $this->info('✓ All application caches have been cleared!');
        
        return Command::SUCCESS;
    }
}
