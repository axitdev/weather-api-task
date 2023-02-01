<?php

declare(strict_types=1);

namespace Infrastructure\City\Services\Geocoding;

use Domains\City\DataObject\CoordinatesDataObject;

interface GeocodingAPIServiceContract
{
    public function getByName(string $cityName): CoordinatesDataObject;
}
