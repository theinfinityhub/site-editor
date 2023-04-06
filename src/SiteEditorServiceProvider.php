<?php

namespace 1clx\SiteBuilder;

use Illuminate\Cookie\CookieJar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class SiteEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('1clx\SiteBuilder\Http\Controllers\SiteEditorController');
        $this->loadViewsFrom(__DIR__ . '/Views', 'editor');
        $this->app['router']->aliasMiddleware('csrf', \1clx\SiteBuilder\Http\Middleware\VerifyCsrfTokenMiddleware::class);

        $this->publishes([
            __DIR__ . '/Views/siteEditor' => base_path('resources/views/vendor/siteEditor'),
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/site-editor'),
        ], 'public');

        Route::prefix('pcx/editor')->group(__DIR__.'/routes/editor.php');
    }
}
