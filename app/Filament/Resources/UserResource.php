<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                TextInput::make('password')->password()
                    ->required(fn($record) => $record === null)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->hiddenOn('edit'),
                Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            TextColumn::make('name')->label('Nama')->sortable()->searchable(),
            TextColumn::make('email')->label('Email')->sortable()->searchable(),
        ];

        // Kolom role hanya tampil untuk admin
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            $columns[] = TextColumn::make('role_names')
                ->label('Role')->sortable()
                ->getStateUsing(fn ($record) => $record->getRoleNames()->join(', '));
        }

        return $table->columns($columns)
            ->filters([
                // Tambahkan filter jika perlu
            ])
            ->actions([
                Tables\Actions\EditAction::make(),     // <-- Aktifkan Edit
                Tables\Actions\DeleteAction::make(),   // <-- Aktifkan Delete
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // Hanya admin yang bisa akses menu User Management di sidebar Filament
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    //Hanya admin yang boleh melihat, membuat, mengedit, dan menghapus user
    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasRole('admin');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
