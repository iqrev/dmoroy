<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | \UnitEnum | null $navigationGroup = 'Pengaturan';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Detail Pengaturan')
                    ->description('Silakan sesuaikan nilai pengaturan di bawah ini.')
                    ->schema([
                        Forms\Components\Placeholder::make('key_label')
                            ->label('Jenis Pengaturan')
                            ->content(fn ($record) => match ($record?->key) {
                                'site_name' => 'Nama Website',
                                'tagline' => 'Tagline / Slogan Website',
                                'whatsapp' => 'Nomor WhatsApp (Contoh: 62812...)',
                                'email' => 'Email Kontak',
                                'address' => 'Alamat Lengkap',
                                'instagram' => 'Link Instagram',
                                'facebook' => 'Link Facebook',
                                'hero_video_id' => 'Link YouTube Hero (Video Background)',
                                'hero_title' => 'Judul Hero (Teks Besar)',
                                'hero_subtitle' => 'Subjudul Hero (Teks Kecil)',
                                'hero_cta_text' => 'Teks Tombol (CTA)',
                                'hero_cta_link' => 'Link Tombol (CTA)',
                                'about_hero_image' => 'Gambar Halaman About Us',
                                default => $record?->key,
                            }),
                        \Awcodes\Curator\Components\Forms\CuratorPicker::make('value')
                            ->label('Pilih Gambar dari Media Library')
                            ->visible(fn ($record) => in_array($record?->key, ['about_hero_image']))
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('value')
                            ->label('Nilai Pengaturan')
                            ->helperText(fn ($record) => match ($record?->key) {
                                'hero_video_id' => 'Tempelkan link YouTube lengkap di sini.',
                                'whatsapp' => 'Gunakan kode negara (62...) tanpa tanda + atau spasi.',
                                default => null,
                            })
                            ->required(fn ($record) => !in_array($record?->key, ['about_hero_image']))
                            ->visible(fn ($record) => !in_array($record?->key, ['about_hero_image']))
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Pengaturan')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'site_name' => 'Nama Website',
                        'tagline' => 'Tagline Website',
                        'whatsapp' => 'WhatsApp',
                        'email' => 'Email',
                        'address' => 'Alamat',
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                        'hero_video_id' => 'Video Hero (YouTube)',
                        'hero_title' => 'Judul Hero',
                        'hero_subtitle' => 'Subjudul Hero',
                        'hero_cta_text' => 'Teks Tombol Hero',
                        'hero_cta_link' => 'Link Tombol Hero',
                        'about_hero_image' => 'Gambar Halaman About Us',
                        default => ucwords(str_replace('_', ' ', $state)),
                    })
                    ->searchable(),
                Tables\Columns\ImageColumn::make('value_image')
                    ->label('Isi / Nilai')
                    ->getStateUsing(fn ($record) => in_array($record->key, ['about_hero_image']) ? \App\Models\Setting::getMediaUrl($record->key) : null)
                    ->toggleable()
                    ->height(40),
                Tables\Columns\TextColumn::make('value')
                    ->label('Isi (Teks)')
                    ->limit(50)
                    ->visible(fn ($record) => !in_array($record->key ?? '', ['about_hero_image'])),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
