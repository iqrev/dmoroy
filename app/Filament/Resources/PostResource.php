<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Berita & Edukasi';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return 'Artikel';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Artikel';
    }

    public static function getModelLabel(): string
    {
        return 'Artikel';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->components([
                Forms\Components\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Artikel')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('categories')
                            ->label('Kategori Artikel')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('status')
                            ->label('Status Publikasi')
                            ->options([
                                'published' => 'Tayang',
                                'draft' => 'Draft',
                            ])
                            ->required()
                            ->default('published'),
                    ])->columns(2),

                Forms\Components\Section::make('Konten & Media')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Isi Artikel')
                            ->required()
                            ->columnSpanFull(),
                        \Awcodes\Curator\Components\Forms\CuratorPicker::make('image')
                            ->label('Gambar Utama')
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Awcodes\Curator\Components\Tables\CuratorColumn::make('image')
                    ->size(40)
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                    }),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
