<?php

declare(strict_types=1);

namespace App\Jobs\Cities;

use Domains\City\Models\City;
use Domains\City\Services\GeocodingAPI\Exceptions\GeocodingApiStatusException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Infrastructure\Weather\Services\WeatherAPI\WeatherAPIServiceContract;

final class UpdateCityWeatherTask implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public int $cityId,
    ) {}

    /**
     * @throws GeocodingApiStatusException
     */
    public function handle(WeatherAPIServiceContract $weatherAPIService): void
    {
        $city = City::query()->with('weather')->findOrFail($this->cityId);

        $temp = $weatherAPIService->getTemp(
            $city->lat,
            $city->lon
        );

        $city->weather()->updateOrCreate([
            'temp' => $temp
        ], [
            'temp' => $temp
        ]);

        $city->save();
    }
}
