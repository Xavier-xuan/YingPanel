<?php

namespace App\Providers;

use App\Contracts\Host;
use App\Services\FrozenService;
use Illuminate\Support\ServiceProvider;

class HostProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Host::class, FrozenService::class);
    }
}
