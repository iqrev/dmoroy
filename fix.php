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
} else {
    echo "App key exists.\n";
}

echo "\n2. CLEARING ALL CACHE...\n";
@unlink($basePath.'/bootstrap/cache/config.php');
@unlink($basePath.'/bootstrap/cache/routes-v7.php');
@unlink($basePath.'/bootstrap/cache/services.php');
@unlink($basePath.'/bootstrap/cache/packages.php');
Artisan::call('route:clear');
Artisan::call('config:clear');
Artisan::call('view:clear');
echo "Cache cleared.\n";

echo "\n3. FORCE FIX STORAGE LINK (ABSOLUTE)...\n";
$publicStoragePath = $basePath . '/public/storage';
$targetStoragePath = $basePath . '/storage/app/public';

if (is_link($publicStoragePath)) {
    echo "Removing old symlink...\n";
    @unlink($publicStoragePath);
} elseif (is_dir($publicStoragePath)) {
    echo "Found storage folder in public. Attempting to rename...\n";
    @rename($publicStoragePath, $publicStoragePath . '_backup_' . time());
}

if (symlink($targetStoragePath, $publicStoragePath)) {
    echo "SUCCESS: Absolute Storage link created!\n";
    echo "Target: $targetStoragePath\n";
    echo "Link: $publicStoragePath\n";
} else {
    echo "FAILED: Could not create symlink. Try manual creation in File Manager.\n";
}

echo "\n4. CHECKING MEDIA FILES...\n";
$mediaCount = is_dir($targetStoragePath) ? count(scandir($targetStoragePath)) - 2 : 0;
echo "Found $mediaCount files in $targetStoragePath\n";

echo "\nCOMPLETED! Website should show images now.\n";
