<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
} else {
    echo "FAILED: Could not create symlink.\n";
}

echo "\n4. CHECKING MEDIA FILES...\n";
$mediaCount = is_dir($targetStoragePath) ? count(scandir($targetStoragePath)) - 2 : 0;
echo "Found $mediaCount files in $targetStoragePath\n";

echo "\n5. SOCIAL MEDIA INTEGRATION...\n";
$socialLinks = [
    'instagram' => 'https://www.instagram.com/batikjambiberkah/',
    'facebook' => 'https://www.facebook.com/batikjambiberkah',
    'youtube' => 'https://www.youtube.com/@batikjambiberkah',
    'tiktok' => 'https://www.tiktok.com/@batikjambiberkah',
    'shopee' => 'https://shopee.co.id/batikjberkah',
    'tokopedia' => 'https://www.tokopedia.com/batikjambiberkah',
];

foreach ($socialLinks as $key => $value) {
    DB::table('settings')->updateOrInsert(
        ['key' => $key],
        ['value' => $value, 'created_at' => now(), 'updated_at' => now()]
    );
    echo "Set $key -> $value\n";
}

echo "\n6. ADMIN USER SYNC...\n";
DB::table('users')->updateOrInsert(
    ['email' => 'admin@websitejambi.com'],
    [
        'name' => 'Admin Website Jambi',
        'password' => password_hash('AmdinPutin123', PASSWORD_BCRYPT),
        'created_at' => now(),
        'updated_at' => now()
    ]
);
echo "Admin admin@websitejambi.com synced!\n";

echo "\nCOMPLETED! Admin and Social links are ready.\n";
