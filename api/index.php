<?php

/**
 * Vercel Serverless Entry Point for Laravel
 * Handles read-only filesystem by redirecting writes to /tmp
 */

// ── Writable directories in /tmp ──────────────────────────────────────────
$storagePath = '/tmp/storage';
$bootstrapCache = '/tmp/bootstrap/cache';

$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/cache/data',
    $storagePath . '/logs',
    $bootstrapCache,
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// ── Copy pre-seeded SQLite DB from repo to /tmp (read-only → writable) ────
$dbPath    = '/tmp/database.sqlite';
$sourcDb   = __DIR__ . '/../database/vercel.sqlite';

if (!file_exists($dbPath) || filesize($dbPath) < 1024) {
    if (file_exists($sourcDb)) {
        copy($sourcDb, $dbPath);
    } else {
        file_put_contents($dbPath, '');
    }
}

// ── Copy compiled views from read-only to /tmp ────────────────────────────
$readonlyViews = __DIR__ . '/../storage/framework/views';
if (is_dir($readonlyViews)) {
    foreach (glob($readonlyViews . '/*.php') as $file) {
        $dest = $storagePath . '/framework/views/' . basename($file);
        if (!file_exists($dest)) {
            copy($file, $dest);
        }
    }
}

// ── Override environment variables before Laravel boots ───────────────────
$_ENV['VERCEL']               = '1';
$_SERVER['VERCEL']            = '1';
$_ENV['DB_CONNECTION']        = 'sqlite';
$_SERVER['DB_CONNECTION']     = 'sqlite';
$_ENV['DB_DATABASE']          = $dbPath;
$_SERVER['DB_DATABASE']       = $dbPath;
$_ENV['SESSION_DRIVER']       = 'cookie';
$_SERVER['SESSION_DRIVER']    = 'cookie';
$_ENV['CACHE_STORE']          = 'array';
$_SERVER['CACHE_STORE']       = 'array';
$_ENV['CACHE_DRIVER']         = 'array';
$_SERVER['CACHE_DRIVER']      = 'array';
$_ENV['LOG_CHANNEL']          = 'stderr';
$_SERVER['LOG_CHANNEL']       = 'stderr';
$_ENV['QUEUE_CONNECTION']     = 'sync';
$_SERVER['QUEUE_CONNECTION']  = 'sync';

// ── Hand off to Laravel ───────────────────────────────────────────────────
require __DIR__ . '/../public/index.php';
