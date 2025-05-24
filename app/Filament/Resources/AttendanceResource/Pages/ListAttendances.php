<?php
namespace App\Filament\Resources\AttendanceResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AttendanceResource;

class ListAttendances extends ListRecords
{
    protected static string $resource = AttendanceResource::class;

    protected function getHeaderActions(): array
{
    $actions = [];

    // Tombol export hanya admin
    if (auth()->user()?->hasRole('admin')) {
        $actions[] = Action::make('showQrCode')
            ->label('QR Attendance')
            ->icon('heroicon-o-qr-code')
            ->color('primary')
            ->modalHeading('QR Code Presensi Aktif')
            ->modalWidth('md')
            ->modalSubmitAction(false)    
            ->modalCancelAction(false)
            ->modalContent(function () {
                $now = now();
                $sessionAktif = \App\Models\AttendanceSession::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->first();
                return view('filament.resources.attendance-resource.partials.qr-modal', compact('sessionAktif'));
            });
        // $actions[] = Actions\CreateAction::make();
        $actions[] = Action::make('export-excel')
            ->label('Export Excel')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('success')
            ->url(route('attendances.export'))
            ->openUrlInNewTab();
    }

    return $actions;
}
    // Livewire handler untuk menampilkan modal
    public function showQrCodeModal()
    {
        $this->dispatch('open-modal', ['id' => 'modal-qr-presensi']);
    }
}
