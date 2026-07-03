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

// ── Copy compiled views & cached configs from read-only to /tmp ───────────
$readonlyViews = __DIR__ . '/../storage/framework/views';
if (is_dir($readonlyViews)) {
    foreach (glob($readonlyViews . '/*.php') as $file) {
        $dest = $storagePath . '/framework/views/' . basename($file);
        if (!file_exists($dest)) {
            copy($file, $dest);
        }
    }
}

// ── Initialise SQLite database in /tmp ────────────────────────────────────
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    file_put_contents($dbPath, '');
}

// ── Override environment variables before Laravel boots ───────────────────
$_ENV['VERCEL']        = '1';
$_SERVER['VERCEL']     = '1';
$_ENV['DB_DATABASE']   = $dbPath;
$_SERVER['DB_DATABASE'] = $dbPath;
$_ENV['VIEW_COMPILED_PATH']  = $storagePath . '/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';

// ── Hand off to Laravel ───────────────────────────────────────────────────
require __DIR__ . '/../public/index.php';
