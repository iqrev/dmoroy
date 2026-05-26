<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components as Schemas;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static string | \UnitEnum | null $navigationGroup = 'Berita & Edukasi';
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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Schemas\Section::make('Informasi Utama')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Artikel')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->readOnly()
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

                Schemas\Section::make('Gambar Utama')
                    ->schema([
                        \Awcodes\Curator\Components\Forms\CuratorPicker::make('image')
                            ->relationship('mediaImage', 'id')
                            ->label('Pilih atau Unggah Gambar Utama')
                            ->directory('posts')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\RichEditor::make('content')
                    ->label(fn () => new \Illuminate\Support\HtmlString('Isi Artikel (Tulis konten di bawah ini) <style>.fi-fo-rich-editor .tiptap, .fi-fo-rich-editor .ProseMirror { min-height: 30rem !important; }</style>'))
                    ->required()
                    ->columnSpanFull(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('gray'),
                \Awcodes\Curator\Components\Tables\CuratorColumn::make('image')
                    ->label('Gambar')
                    ->size(40),
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
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
