<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Attendance;

class RecentActivity extends Widget
{
    protected static string $view = 'filament.widgets.recent-activity';

    public $recentLogs = [];

    public function mount()
    {
        $this->recentLogs = Attendance::latest()
            ->with('user')
            ->take(8)
            ->get();
    }
}
