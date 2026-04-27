<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

define('LARAVEL_START', microtime(true));

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    $basePath = __DIR__;
} elseif (file_exists(__DIR__.'/../vendor/autoload.php')) {
    $basePath = __DIR__.'/..';
} else {
    die("Could not find vendor/autoload.php.");
}

require $basePath.'/vendor/autoload.php';
$app = require_once $basePath.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<pre>";
echo "PHP: " . phpversion() . "\n";

echo "1. CLEARING ALL CACHE...\n";
@unlink($basePath.'/bootstrap/cache/config.php');
@unlink($basePath.'/bootstrap/cache/routes-v7.php');
@unlink($basePath.'/bootstrap/cache/services.php');
@unlink($basePath.'/bootstrap/cache/packages.php');

Artisan::call('route:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
echo "Cache cleared.\n\n";

echo "2. SAFE STORAGE LINKING...\n";
$publicStoragePath = $basePath . '/public/storage';
if (file_exists($publicStoragePath)) {
    echo "Storage link already exists. Skipping...\n";
} else {
    try {
        if (function_exists('symlink')) {
            Artisan::call('storage:link');
            echo "Storage link created via Artisan.\n";
        } else {
            echo "Fungsi symlink() dinonaktifkan oleh Hostinger. Silakan buat link manual di File Manager.\n";
        }
    } catch (\Exception $e) {
        echo "Error creating link: " . $e->getMessage() . "\n";
    }
}

echo "\n3. DEBUGGING ROUTES:\n";
$routes = Route::getRoutes();
foreach ($routes as $route) {
    echo "[" . implode('|', $route->methods()) . "] " . $route->uri() . " -> " . $route->getName() . "\n";
}

echo "\nCOMPLETED! Please visit your home page.\n";
