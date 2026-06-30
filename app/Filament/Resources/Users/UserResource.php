<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string | \UnitEnum | null $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Karyawan / Admin';
    protected static ?int $navigationSort = 10;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\Select::make('role')
                    ->label('Pangkat / Hak Akses')
                    ->options([
                        'admin' => 'Admin (Akses Penuh)',
                        'operator' => 'Operator (Pengelola Konten)',
                    ])
                    ->required()
                    ->default('operator'),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Pangkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'operator' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUsers::route('/'),
        ];
    }
}
