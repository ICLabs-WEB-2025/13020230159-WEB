<x-filament-widgets::widget>
    <div class="rounded-lg shadow p-4 bg-white dark:bg-gray-900 mb-4">
        <h3 class="font-bold mb-2 text-lg text-gray-800 dark:text-gray-100">Leaderboard Kehadiran Bulan Ini</h3>
        <ul>
            @foreach($topAsisten as $asisten)
                <li class="flex items-center mb-2">
                    <span class="font-semibold w-8 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}.</span>
                    <span class="flex-1 text-gray-700 dark:text-gray-200">{{ $asisten->name }}</span>
                    <span class="text-green-600 dark:text-green-400 font-bold">{{ $asisten->hadir }} Hadir</span>
                </li>
            @endforeach
            @if($topAsisten->isEmpty())
                <li class="text-gray-500 dark:text-gray-400">Belum ada data kehadiran.</li>
            @endif
        </ul>
    </div>
</x-filament-widgets::widget>
