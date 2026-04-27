<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

define('LARAVEL_START', microtime(true));

// Try to find autoloader in current or parent directory
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    $basePath = __DIR__;
} elseif (file_exists(__DIR__.'/../vendor/autoload.php')) {
    $basePath = __DIR__.'/..';
} else {
    die("Could not find vendor/autoload.php. Please make sure fix.php is in the project root or public_html folder.");
}

require $basePath.'/vendor/autoload.php';
$app = require_once $basePath.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<pre>";
echo "Using PHP Version: " . phpversion() . "\n";

echo "PERFORMING TOTAL CACHE PURGE...\n";
@unlink($basePath.'/bootstrap/cache/config.php');
@unlink($basePath.'/bootstrap/cache/routes-v7.php');
@unlink($basePath.'/bootstrap/cache/services.php');
@unlink($basePath.'/bootstrap/cache/packages.php');

Artisan::call('route:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');

echo "DEBUGGING ROUTES:\n";
$routes = Route::getRoutes();
foreach ($routes as $route) {
    echo "[" . implode('|', $route->methods()) . "] " . $route->uri() . " -> " . $route->getName() . "\n";
}

echo "\nTOTAL PURGE COMPLETE! Please refresh your website main page.\n";
echo "Note: I am NOT re-optimizing to avoid broken cache files.\n";

echo "\nDone!";
