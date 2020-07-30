<?php

namespace Doc88\FluxMenuControl;

use Illuminate\Support\ServiceProvider;

class FluxMenuControlServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
    }
}
