<?php

use Illuminate\Support\Facades\Artisan;

define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "<pre>";
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
