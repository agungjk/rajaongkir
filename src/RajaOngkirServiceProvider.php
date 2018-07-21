<?php

namespace Agungjk\Rajaongkir;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class RajaOngkirServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/config/rajaongkir.php' => config_path('rajaongkir.php'),
            ]);
    }

    /**
     * Register the application services.
     *
     */
    public function register()
    {
        $this->app->singleton('rajaongkir', function () {
            $guzzle = new Client([
                'base_uri' => rtrim(config('rajaongkir.end_point_api'), '/').'/',
                'headers' => [
                    'key' => config('rajaongkir.api_key'),
                ],
            ]);

            return new RajaOngkir($guzzle);
        });
    }
}
