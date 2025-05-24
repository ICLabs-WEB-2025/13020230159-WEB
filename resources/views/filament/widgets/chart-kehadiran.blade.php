<x-filament-widgets::widget>
    <div class="rounded-xl shadow-lg p-4 bg-white dark:bg-gray-900">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
            {{ $this->getHeading() }}
        </h3>
        <div>
            {!! $this->renderChart() !!}
        </div>
    </div>
</x-filament-widgets::widget>
