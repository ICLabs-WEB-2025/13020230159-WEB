<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CustomDashboard extends Page
{
    protected static ?string $navigationLabel = 'Home'; // ← Nama di sidebar  
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $title = '';
    protected static string $view = 'filament.pages.custom-dashboard';

    protected static ?array $widgets = [
        \App\Filament\Widgets\TotalPresensiHariIni::class,
        \App\Filament\Widgets\TotalAkunAccess::class,
        \App\Filament\Widgets\LeaderboardAsisten::class,
        \App\Filament\Widgets\RecentActivity::class,
        \App\Filament\Widgets\CalendarWidget::class,
    ];

    public function mount()
    {
      
    }

}