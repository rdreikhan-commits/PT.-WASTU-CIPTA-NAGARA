<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override view compiled path and cache paths for Vercel serverless
        if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
            $storagePath = '/tmp/storage';
            config(['view.compiled' => $storagePath . '/framework/views']);
            config(['cache.stores.file.path' => $storagePath . '/framework/cache/data']);
            config(['session.files' => $storagePath . '/framework/sessions']);
            config(['logging.channels.single.path' => $storagePath . '/logs/laravel.log']);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS on production (Vercel)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
