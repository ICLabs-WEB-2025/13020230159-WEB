<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use App\Filament\Widgets\TotalPresensiHariIni;
use App\Filament\Widgets\TotalAkunAccess;
use App\Filament\Widgets\ChartKehadiran;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::registerWidgets([
            TotalPresensiHariIni::class,
            TotalAkunAccess::class,
            ChartKehadiran::class,
    ]);
    }
}
