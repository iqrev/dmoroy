<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Action;
use App\Models\Product;
use App\Models\Post;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Export extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected string $view = 'filament.pages.export';

    protected static string | \UnitEnum | null $navigationGroup = 'Pengaturan';

    protected static ?string $title = 'Export Data';

    protected static ?int $navigationSort = 2;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form($form)
    {
        return $form
            ->schema([
                Section::make('Pilih Data yang Akan Diekspor')
                    ->description('Silakan pilih jenis data yang ingin Anda unduh dalam format CSV.')
                    ->schema([
                        Select::make('type')
                            ->label('Tipe Data')
                            ->options([
                                'products' => 'Produk',
                                'posts' => 'Artikel / Berita',
                            ])
                            ->required()
                            ->native(false),
                    ])
            ])
            ->statePath('data');
    }

    public function export(): StreamedResponse
    {
        $payload = $this->form->getState();
        $type = $payload['type'];

        return response()->streamDownload(function () use ($type) {
            $handle = fopen('php://output', 'w');

            if ($type === 'products') {
                // Header
                fputcsv($handle, ['ID', 'Nama Produk', 'Slug', 'Kategori', 'Harga', 'Stok', 'Status', 'Unggulan']);

                Product::with('category')->chunk(100, function ($products) use ($handle) {
                    foreach ($products as $product) {
                        fputcsv($handle, [
                            $product->id,
                            $product->name,
                            $product->slug,
                            $product->category?->name ?? '-',
                            $product->price,
                            $product->stock,
                            $product->status,
                            $product->is_featured ? 'Ya' : 'Tidak',
                        ]);
                    }
                });
            } else {
                // Header
                fputcsv($handle, ['ID', 'Judul Artikel', 'Slug', 'Status', 'Tanggal Dibuat', 'Isi Konten (Text Only)']);

                Post::chunk(100, function ($posts) use ($handle) {
                    foreach ($posts as $post) {
                        fputcsv($handle, [
                            $post->id,
                            $post->title,
                            $post->slug,
                            $post->status,
                            $post->created_at->format('Y-m-d H:i:s'),
                            strip_tags($post->content),
                        ]);
                    }
                });
            }

            fclose($handle);
        }, "export-{$type}-" . now()->format('Y-m-d') . ".csv");
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('export')
                ->label('Unduh CSV')
                ->submit('export')
                ->color('primary'),
        ];
    }
}
