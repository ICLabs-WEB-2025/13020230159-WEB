<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Tambahkan ini

class RekapKehadiranExport implements FromCollection, WithHeadings // Implementasikan WithHeadings
{
    public function collection()
    {
        $users = User::whereDoesntHave('roles', function ($q) {
                $q->where('name', 'admin');
            })
            ->withCount([
                'attendances as hadir' => fn ($q) => $q->where('status', 'hadir')->whereMonth('waktu_presensi', now()->month),
                'attendances as absen' => fn ($q) => $q->where('status', 'absen')->whereMonth('waktu_presensi', now()->month),
            ])
            ->get();

        $rekap = $users->map(function ($user) {
            $total = $user->hadir + $user->absen;
            return [
                'Nama'       => $user->name,
                'Hadir'      => $user->hadir,
                'Absen'      => $user->absen,
                'Persentase' => $total > 0 ? round($user->hadir / $total * 100, 1) . '%' : '0%',
            ];
        });

        return collect($rekap);
    }

    // Tambahkan headings
    public function headings(): array
    {
        return [
            'Nama',
            'Hadir',
            'Absen',
            'Persentase',
        ];
    }
}
