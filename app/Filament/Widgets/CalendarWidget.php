<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CalendarWidget extends Widget
{
    protected static string $view = 'filament.widgets.calendar-widget';

    protected int|string|array $columnSpan = 'full';
}
