<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$action = \Filament\Actions\Action::make('launchPanel')
    ->label('Test Label')
    ->button();

echo "HTML: " . $action->toHtml() . "\n";
