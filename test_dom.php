<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$picker = \Awcodes\Curator\Components\Forms\CuratorPicker::make('mediaImages')
    ->relationship('mediaImages', 'id')
    ->multiple();
    
echo $picker->toHtml();
