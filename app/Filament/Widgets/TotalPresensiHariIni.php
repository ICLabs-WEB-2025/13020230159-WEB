<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Attendance;
use Carbon\Carbon;

class TotalPresensiHariIni extends Widget
{
    protected static string $view = 'filament.widgets.total-presensi-hari-ini';

    public int $totalPresensi = 0;

    public function mount(): void
    {
        $this->totalPresensi = Attendance::whereDate('waktu_presensi', Carbon::today())
            ->count();
    }
}
