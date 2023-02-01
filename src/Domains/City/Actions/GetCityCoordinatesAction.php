<?php

declare(strict_types=1);

namespace Domains\City\Actions;

use Domains\City\DataObject\CoordinatesDataObject;
use Infrastructure\City\Services\Geocoding\GeocodingAPIServiceContract;

final class GetCityCoordinatesAction
{
    public function __construct(
        private GeocodingAPIServiceContract $geocodingService,
    ) {}

    public function handle(string $name): CoordinatesDataObject
    {
        return $this->geocodingService->getByName($name);
    }
}
