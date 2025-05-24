<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;

class TotalAkunAccess extends Widget
{
    protected static string $view = 'filament.widgets.total-akun-access';
    public function getTotalAkunProperty(): int
    {
        return User::count(); 
    }
}
