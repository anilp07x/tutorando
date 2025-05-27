<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Publicacao;
use App\Models\Projeto;
use App\Models\User;

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
        // Force HTTPS on assets in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
        
        // Register model observers for cache invalidation
        $this->registerModelObservers();
        
        // Log slow queries in development
        $this->logSlowQueries();
        
        // Register custom Blade directives
        $this->registerBladeDirectives();
    }
    
    /**
     * Register model observers for cache invalidation
     */
    private function registerModelObservers(): void
    {
        // Clear relevant caches when models are updated
        Publicacao::saved(function ($publicacao) {
            Cache::forget('public-publicacoes');
            Cache::forget('admin-dashboard-stats');
            Cache::forget('publicacao-'.$publicacao->id);
        });
        
        Publicacao::deleted(function () {
            Cache::forget('public-publicacoes');
            Cache::forget('admin-dashboard-stats');
        });
        
        Projeto::saved(function ($projeto) {
            Cache::forget('admin-dashboard-stats');
            Cache::forget('projeto-'.$projeto->id);
        });
        
        Projeto::deleted(function () {
            Cache::forget('admin-dashboard-stats');
        });
        
        User::saved(function () {
            Cache::forget('admin-dashboard-stats');
        });
    }
    
    /**
     * Log slow queries during development
     */
    private function logSlowQueries(): void
    {
        if (config('app.env') === 'local' || config('app.debug')) {
            DB::listen(function ($query) {
                if ($query->time > 100) {
                    Log::channel('query')->info('Slow Query', [
                        'sql' => $query->sql,
                        'bindings' => $query->bindings,
                        'time' => $query->time . 'ms'
                    ]);
                }
            });
        }
    }
    
    /**
     * Register custom Blade directives
     */
    private function registerBladeDirectives(): void
    {
        // Add a cache directive to cache partial views
        Blade::directive('cachesection', function ($expression) {
            return "<?php if (! app()->environment('local')): ?> 
                    <?php echo cache()->remember({$expression}, now()->addHours(24), function() { ob_start() ?>";
        });
        
        Blade::directive('endcachesection', function () {
            return "<?php return ob_get_clean(); }); ?>
                    <?php else: ?>
                    <?php ob_start() ?>";
        });
        
        Blade::directive('endcachelocal', function () {
            return "<?php echo ob_get_clean(); ?>
                    <?php endif; ?>";
        });
    }
}
