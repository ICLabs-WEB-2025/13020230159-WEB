<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendancesExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Pastikan eager load 'user' agar efisien
        return Attendance::with('user')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Asisten',
            'Status',
            'Waktu Presensi',
        ];
    }

    public function map($attendance): array
    {
        return [
            $attendance->user?->name ?? 'Tanpa Nama', // Nama Asisten
            $attendance->status,
            $attendance->waktu_presensi,
        ];
    }
}
