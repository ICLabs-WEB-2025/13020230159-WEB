<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Attendance;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Exports\AttendancesExport;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\AttendanceResource\Pages;


class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';


    public function export()
    {
        return Excel::download(new AttendancesExport, 'attendances.xlsx');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            // TIDAK PERLU ADA user_id DI FORM!
            // Pilihan status presensi
             Placeholder::make('asisten')
                ->label('Nama Asisten')
                ->content(fn () => auth()->user()->name),
            Select::make('status')
                ->label('Status')
                ->options([
                    'hadir' => 'Hadir',
                    'absen' => 'Absen',
                ])
                ->default('hadir')
                ->required(),
                
            // Waktu presensi otomatis (display only)
            TextInput::make('waktu_presensi')
                ->label('Waktu Presensi')
                ->default(now())
                ->disabled()
                ->dehydrated(false),
            ]);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['waktu_presensi'] = now();
        dd($data);
        return $data;
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Asisten')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->badge()->color(fn ($state) => $state === 'absen' ? 'danger' : 'success'),
                TextColumn::make('waktu_presensi')->label('Waktu Presensi')->datetime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Asisten'),
                Tables\Filters\Filter::make('periode')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('to')->label('Sampai'),
                ])
                    ->query(function ($query, $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('waktu_presensi', '>=', $date))
                            ->when($data['to'], fn ($q, $date) => $q->whereDate('waktu_presensi', '<=', $date));
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            
            ]);
    }


    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('asisten') || auth()->user()?->hasRole('admin');
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasRole('asisten') || auth()->user()?->hasRole('admin');
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
