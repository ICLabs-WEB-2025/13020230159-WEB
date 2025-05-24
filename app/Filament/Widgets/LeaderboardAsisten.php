<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;

class LeaderboardAsisten extends Widget
{
    protected static string $view = 'filament.widgets.leaderboard-asisten';

    public $topAsisten = [];

    public function mount()
    {
        $this->topAsisten = User::withCount(['attendances as hadir' => function ($q) {
            $q->where('status', 'hadir')->whereMonth('waktu_presensi', now()->month);
        }])
        ->orderByDesc('hadir')
        ->take(7)
        ->get();
    }
}
