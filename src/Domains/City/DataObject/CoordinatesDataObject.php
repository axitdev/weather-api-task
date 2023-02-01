<?php

declare(strict_types=1);

namespace Domains\City\DataObject;


final class CoordinatesDataObject
{
    public string $lat;
    public string $lon;

    public static function make(string $lat, string $lon): CoordinatesDataObject
    {
        $dataObject = new self();
        $dataObject->lat = $lat;
        $dataObject->lon = $lon;

        return $dataObject;
    }
}
