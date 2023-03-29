<?php

namespace KUHdo\Content;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

/**
 * @codeCoverageIgnore
 */
class ContentServiceProvider extends ServiceProvider
{
    /**
     * Will boot up the package environment.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        Route::group([
            'prefix' => config('content.prefix'),
            'middleware' => config('content.middleware'),
        ], fn() => $this->loadRoutesFrom(__DIR__ . '/../routes/web.php'));

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('content.php'),
            ], 'config');
        }
    }

    /**
     * Will register the package environment.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'content');

        $this->app->bind('content', function () {
            return new Content();
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('Content', Content::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return ['content'];
    }
}
