<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Presence;
use App\Policies\PresencePolicy;


class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Presence::class => PresencePolicy::class,
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
