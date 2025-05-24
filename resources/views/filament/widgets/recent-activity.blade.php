<x-filament-widgets::widget>
    <div class="rounded-lg shadow p-4 bg-white dark:bg-gray-900 mb-4">
        <h3 class="font-bold mb-2 text-lg text-gray-800 dark:text-gray-100">Aktivitas Terbaru</h3>
        <ul>
            @foreach($recentLogs as $log)
                <li class="grid grid-cols-12 items-center mb-2">
                    <span class="col-span-3 text-xs text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($log->created_at)->format('d M H:i') }}</span>
                    <span class="col-span-5 font-medium text-gray-800 dark:text-gray-100">{{ $log->user->name }}</span>
                    <span class="col-span-4 text-right font-semibold {{ $log->status === 'hadir' ? 'text-green-700 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ ucfirst($log->status) }}
                    </span>
                </li>
            @endforeach
            @if($recentLogs->isEmpty())
                <li class="text-gray-500 dark:text-gray-400">Belum ada aktivitas.</li>
            @endif
        </ul>
    </div>
</x-filament-widgets::widget>
