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

echo "1. GENERATING APP_KEY...\n";
if (empty(env('APP_KEY'))) {
    Artisan::call('key:generate', ['--force' => true]);
    echo Artisan::output();
    echo "App key generated successfully!\n\n";
} else {
    echo "App key already exists. Skipping...\n\n";
}

echo "2. CLEARING ALL CACHE...\n";
@unlink($basePath.'/bootstrap/cache/config.php');
@unlink($basePath.'/bootstrap/cache/routes-v7.php');
@unlink($basePath.'/bootstrap/cache/services.php');
@unlink($basePath.'/bootstrap/cache/packages.php');

Artisan::call('route:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
echo "Cache cleared.\n\n";

echo "3. SAFE STORAGE LINKING...\n";
$publicStoragePath = $basePath . '/public/storage';
if (file_exists($publicStoragePath)) {
    echo "Storage link already exists.\n";
} else {
    try {
        if (function_exists('symlink')) {
            Artisan::call('storage:link');
            echo "Storage link created.\n";
        } else {
            echo "symlink() disabled. Need manual link in File Manager.\n";
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}

echo "\n4. DEBUGGING ROUTES:\n";
$routes = Route::getRoutes();
foreach ($routes as $route) {
    echo "[" . implode('|', $route->methods()) . "] " . $route->uri() . " -> " . $route->getName() . "\n";
}

echo "\nCOMPLETED! Website should be live now.\n";
