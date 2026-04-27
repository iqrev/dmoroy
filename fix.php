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
echo "Optimizing framework...\n";
Artisan::call('optimize');
echo Artisan::output();

echo "Clearing views...\n";
Artisan::call('view:clear');
echo Artisan::output();

echo "Linking storage...\n";
Artisan::call('storage:link');
echo Artisan::output();

echo "\nDone!";
