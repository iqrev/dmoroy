<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$livewire = new class extends \Livewire\Component {
    use \Filament\Forms\Concerns\InteractsWithForms;
    public $mediaImages;
    public function form(\Filament\Forms\Form $form): \Filament\Forms\Form {
        return $form->schema([
            \Awcodes\Curator\Components\Forms\CuratorPicker::make('mediaImages')->relationship('mediaImages', 'id')->multiple()
        ])->model(\App\Models\Product::class);
    }
};

$form = $livewire->form(\Filament\Forms\Form::make($livewire));
echo $form->render();
