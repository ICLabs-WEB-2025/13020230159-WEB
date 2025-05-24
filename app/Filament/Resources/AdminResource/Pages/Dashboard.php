<?php

namespace App\Filament\Resources\AdminResource\Pages;

use Filament\Resources\Pages\Page;

class Dashboard extends Page
{

   public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->user()?->hasRole('admin');
    }

    // Jika parent class memang punya canAcces
    
    protected function getFooterWidgets(): array
    {
        return [

        ];
    }

}
