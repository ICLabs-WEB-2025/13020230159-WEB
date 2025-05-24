<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use App\Models\Attendance;
use Carbon\Carbon;

class ChartKehadiran extends LineChartWidget
{
    protected static ?string $heading = 'Statistik Kehadiran Mingguan';

    protected function getData(): array
    {
        // Ambil data presensi 7 hari terakhir
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);
            $labels[] = $tanggal->isoFormat('ddd, D MMM');
            $data[] = Attendance::whereDate('waktu_presensi', $tanggal)->count();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Presensi',
                    'data' => $data,
                ],
            ],
        ];
    }
}
