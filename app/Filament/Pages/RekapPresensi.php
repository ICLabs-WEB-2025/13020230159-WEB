<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\User;
use App\Models\AttendanceSession; // <-- pastikan ada ini

class RekapPresensi extends Page
{
    protected static ?string $navigationLabel = 'Report'; // ← Nama di sidebar
    protected static ?string $title = '';  
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.rekap-presensi';

    public $rekap = [];

    // --- Tambahkan variabel public untuk session aktif:
    public $sessionAktif = null;

    public function mount()
    {
        // Eclude user dengan role 'admin'
        $this->rekap = User::whereDoesntHave('roles', function ($query) {
                $query->where('name', 'admin');
            })
            ->withCount([
                'attendances as hadir' => fn ($q) => $q->where('status', 'hadir')->whereMonth('waktu_presensi', now()->month),
                'attendances as absen' => fn ($q) => $q->where('status', 'absen')->whereMonth('waktu_presensi', now()->month),
            ])
            ->get()
            ->map(function ($user) {
                $total = $user->hadir + $user->absen;
                return [
                    'nama' => $user->name,
                    'hadir' => $user->hadir,
                    'absen' => $user->absen,
                    'persentase' => $total > 0 ? round($user->hadir / $total * 100, 1) . '%' : '0%',
                ];
            })->toArray();

        // --- Inisialisasi sessionAktif untuk modal QR
        $this->sessionAktif = AttendanceSession::where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->latest()
            ->first();
    }

    protected function getViewData(): array
    {
        return [
            'rekap' => $this->rekap,
            'sessionAktif' => $this->sessionAktif, // <-- pastikan dikirim ke blade
        ];
    }

    public static function canAccess(): bool
    {
        // Ganti 'admin' dengan nama role yang boleh mengakses
        return auth()->user() && auth()->user()->hasRole('admin');
    }
}
