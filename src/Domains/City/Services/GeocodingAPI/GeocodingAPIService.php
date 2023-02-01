<?php

declare(strict_types=1);

namespace Domains\City\Services\GeocodingAPI;

use Domains\City\DataObject\CoordinatesDataObject;
use Domains\City\Services\GeocodingAPI\Exceptions\GeocodingApiStatusException;
use Illuminate\Support\Facades\Http;
use Infrastructure\City\Services\Geocoding\GeocodingAPIServiceContract;
use Symfony\Component\HttpFoundation\Response;

final class GeocodingAPIService implements GeocodingAPIServiceContract
{
    public function __construct(
        private string $baseUrl,
        private string $token,
    ) {}

    /**
     * @throws GeocodingApiStatusException
     */
    public function getByName(string $cityName): CoordinatesDataObject
    {
        $response = Http::accept('application/json')
            ->timeout(
                config('services.geocoding.timeout')
            )
            ->get($this->baseUrl, [
                'q' => $cityName,
                'limit' => 1,
                'appid' => $this->token,
            ]);

        if ($response->status() !== Response::HTTP_OK) {
            throw new GeocodingApiStatusException(
                sprintf('Geocoding API error, with http code: %s', $response->status())
            );
        }

        return CoordinatesDataObject::make(
            lat: (string)$response[0]['lat'],
            lon: (string)$response[0]['lon']
        );
    }
}
