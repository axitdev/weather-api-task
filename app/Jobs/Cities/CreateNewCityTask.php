<?php

declare(strict_types=1);

namespace App\Jobs\Cities;

use Domains\City\Actions\GetCityCoordinatesAction;
use Domains\City\Actions\MakeNewCityAction;
use Domains\City\Models\City;
use Domains\City\Services\GeocodingAPI\Exceptions\GeocodingApiStatusException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreateNewCityTask implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $name,
    ) {}

    /**
     * @throws GeocodingApiStatusException
     */
    public function handle(MakeNewCityAction $makeCityAction, GetCityCoordinatesAction $getCityCoordinatesAction): void
    {
        if (City::query()->where('name', $this->name)->exists()) {
            throw new GeocodingApiStatusException(
                sprintf('City with name %s, already exist', $this->name)
            );
        }

        $city = $makeCityAction->handle(
            $this->name,
            $getCityCoordinatesAction->handle($this->name)
        );

        $city->save();
    }
}
