<?php

declare(strict_types=1);

namespace Domains\Weather\Actions;

use Domains\City\DataObject\CoordinatesDataObject;

final class UpdateWeatherActions
{
    public function handle(CoordinatesDataObject $coordinates): int
    {
        return 25;
    }
}
