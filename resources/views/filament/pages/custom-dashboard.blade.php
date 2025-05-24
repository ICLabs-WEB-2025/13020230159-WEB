<x-filament::page>
    <div class="w-full flex justify-center">
        <div class="w-full max-w-5xl flex flex-col gap-6 px-2 mt-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-amber-500 drop-shadow-sm">Selamat Datang di Dashboard Presensi Asisten</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-300">
                    Pantau kehadiran asisten dengan mudah, efisien, dan penuh semangat.  
                    Jadikan setiap kehadiran berarti dan produktif!
                </p>
            </div>
            <div class="flex flex-row gap-6">
                <div class="flex-1">
                    @livewire('app.filament.widgets.total-presensi-hari-ini')
                </div>
                <div class="flex-1">
                    @livewire('app.filament.widgets.total-akun-access')
                </div>
            </div>
            <div class="flex flex-row gap-6">
                <div class="flex-1">
                     @livewire('app.filament.widgets.leaderboard-asisten')
                </div>
                <div class="flex-1">
                     @livewire('app.filament.widgets.calendar-widget')
                </div>
            </div>
            <div>
                    @livewire('app.filament.widgets.recent-activity')
            </div> 
            <div>
                    @livewire('app.filament.widgets.chart-kehadiran')
            </div> 
        </div>
    </div>
</x-filament::page>


