<?php

declare(strict_types=1);

namespace Domains\City\Actions;

use Domains\City\DataObject\CoordinatesDataObject;
use Domains\City\Models\City;
use Illuminate\Database\Eloquent\Model;

final class MakeNewCityAction
{
    public function handle(string $name, CoordinatesDataObject $coordinates): City|Model
    {
        return City::query()->make(
            attributes: [
                'name' => $name,
                'lat' => $coordinates->lat,
                'lon' => $coordinates->lon,
            ]);
    }
}
