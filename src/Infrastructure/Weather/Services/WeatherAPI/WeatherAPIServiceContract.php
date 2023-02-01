<?php

declare(strict_types=1);

namespace Infrastructure\Weather\Services\WeatherAPI;

interface WeatherAPIServiceContract
{
    public function getTemp(string $lat, string $lon): int;
}
