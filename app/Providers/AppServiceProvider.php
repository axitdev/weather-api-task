<?php

namespace App\Providers;

use Domains\City\Services\GeocodingAPI\GeocodingAPIService;
use Domains\Weather\Services\WeatherAPI\WeatherAPIService;
use Illuminate\Support\ServiceProvider;
use Infrastructure\City\Services\Geocoding\GeocodingAPIServiceContract;
use Infrastructure\Weather\Services\WeatherAPI\WeatherAPIServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            abstract: GeocodingAPIServiceContract::class,
            concrete: fn () => new GeocodingAPIService(
                baseUrl: (string)config('services.geocoding.url'),
                token: (string)config('services.geocoding.token'),
            ),
        );

        $this->app->singleton(
            abstract: WeatherAPIServiceContract::class,
            concrete: fn () => new WeatherAPIService(
                baseUrl: (string)config('services.weather.url'),
                token: (string)config('services.weather.token'),
            ),
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
