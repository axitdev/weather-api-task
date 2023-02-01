<?php

declare(strict_types=1);

namespace Domains\Weather\Services\WeatherAPI;

use Domains\Weather\Services\WeatherAPI\Exceptions\WeatherApiStatusException;
use Illuminate\Support\Facades\Http;
use Infrastructure\Weather\Services\WeatherAPI\WeatherAPIServiceContract;
use Symfony\Component\HttpFoundation\Response;

final class WeatherAPIService implements WeatherAPIServiceContract
{
    public function __construct(
        private string $baseUrl,
        private string $token,
    ) {}

    /**
     * @throws WeatherApiStatusException
     */
    public function getTemp(string $lat, string $lon): int
    {
        $response = Http::accept('application/json')
            ->timeout(
                config('services.weather.timeout')
            )
            ->get($this->baseUrl, [
                'lat' => $lat,
                'lon' => $lon,
                'appid' => $this->token,
            ]);

        if ($response->status() !== Response::HTTP_OK) {
            throw new WeatherApiStatusException(
                sprintf('Weather API error, with http code: %s', $response->status())
            );
        }

        return (int)$response['main']['temp'];
    }
}
