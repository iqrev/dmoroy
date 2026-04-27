<?php

use Illuminate\Support\Facades\Artisan;

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

echo "Manually deleting cache files...\n";
@unlink($basePath.'/bootstrap/cache/config.php');
@unlink($basePath.'/bootstrap/cache/routes-v7.php');
@unlink($basePath.'/bootstrap/cache/services.php');
@unlink($basePath.'/bootstrap/cache/packages.php');

echo "Clearing View Cache...\n";
Artisan::call('view:clear');
echo Artisan::output();

echo "Clearing Route Cache...\n";
Artisan::call('route:clear');
echo Artisan::output();

echo "Clearing Config Cache...\n";
Artisan::call('config:clear');
echo Artisan::output();

echo "Clearing Compiled Classes...\n";
Artisan::call('clear-compiled');
echo Artisan::output();

echo "\nTOTAL PURGE COMPLETE! Please refresh your website main page.\n";
echo "Note: I am NOT re-optimizing to avoid broken cache files.\n";

echo "\nDone!";
