<?php

namespace Agungjk\Rajaongkir;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/config/rajaongkir.php' => config_path('config/rajaongkir.php'),
            ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rajaongkir', function() {
            return true;
        });

        App::bind('rajaongkir', function()
        {
            return new RajaOngkir;
        });
    }
}