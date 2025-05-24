<x-filament-widgets::widget>
    <div class="rounded-lg shadow p-4 bg-white dark:bg-gray-900">
        <h3 class="font-bold text-lg mb-2 text-gray-800 dark:text-gray-100">Kalender</h3>
        <div class="overflow-auto">
            <div class="text-center font-semibold text-gray-700 dark:text-gray-300 mb-2">
                {{ now()->translatedFormat('F Y') }}
            </div>
            <table class="w-full table-fixed text-center">
                <thead>
                    <tr class="text-gray-600 dark:text-gray-400">
                        @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                            <th>{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="text-gray-700 dark:text-gray-200">
                    @php
                        $today = now();
                        $firstDay = now()->startOfMonth();
                        $lastDay = now()->endOfMonth();
                        $startWeekday = $firstDay->dayOfWeek;
                    @endphp
                    @for($i = 0; $i < ceil(($startWeekday + $lastDay->day) / 7); $i++)
                        <tr>
                            @for($j = 0; $j < 7; $j++)
                                @php
                                    $currentDay = ($i * 7 + $j) - $startWeekday + 1;
                                @endphp
                                @if($currentDay > 0 && $currentDay <= $lastDay->day)
                                    <td class="{{ $today->day == $currentDay ? 'bg-amber-500 text-white rounded-full' : '' }} py-1">
                                        {{ $currentDay }}
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</x-filament-widgets::widget>
