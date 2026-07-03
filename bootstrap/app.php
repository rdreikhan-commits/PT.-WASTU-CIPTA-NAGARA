<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

// Vercel serverless read-only filesystem workaround
if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $storagePath = '/tmp/storage';

    $dirs = [
        $storagePath . '/framework/views',
        $storagePath . '/framework/sessions',
        $storagePath . '/framework/cache/data',
        $storagePath . '/logs',
        '/tmp/bootstrap/cache',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    $app->useStoragePath($storagePath);

    // SQLite database in /tmp
    $dbPath = $_ENV['DB_DATABASE'] ?? '/tmp/database.sqlite';
    if (!file_exists($dbPath)) {
        file_put_contents($dbPath, '');
    }
}

return $app;

