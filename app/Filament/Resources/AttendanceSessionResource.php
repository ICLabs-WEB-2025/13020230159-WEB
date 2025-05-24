<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\AttendanceSession;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttendanceSessionResource\Pages;
use App\Filament\Resources\AttendanceSessionResource\RelationManagers;

class AttendanceSessionResource extends Resource
{
    protected static ?string $model = AttendanceSession::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Nama Sesi')->required(),
                DateTimePicker::make('start_time')->label('Mulai QR Aktif')->required(),
                DateTimePicker::make('end_time')->label('Selesai QR Aktif')->required(),
                TextInput::make('token')->label('Token')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Sesi')->searchable(),
                TextColumn::make('start_time')->label('Mulai')->dateTime('d M Y H:i'),
                TextColumn::make('end_time')->label('Selesai')->dateTime('d M Y H:i'),
                TextColumn::make('token')->label('Token')->copyable(),
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
            'index' => Pages\ListAttendanceSessions::route('/'),
            'create' => Pages\CreateAttendanceSession::route('/create'),
            'edit' => Pages\EditAttendanceSession::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        // Ganti 'admin' dengan nama role yang boleh mengakses
        return auth()->user() && auth()->user()->hasRole('admin');
    }
}
