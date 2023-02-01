<?php

namespace App\Http\Controllers\Api\Weather;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cities\UpdateCitiesRequest;

use App\Jobs\Cities\UpdateCityWeatherTask;
use Domains\City\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

final class WeatherUpdateController extends Controller
{
    public function __invoke(UpdateCitiesRequest $request)
    {
        $cities = City::query()
            ->whereIn('name', $request->cities)
            ->get();

        $errors = $this->checkCities($cities, $request->cities);
        if ($errors) {
            return new JsonResponse(
                data: $errors,
                status: Response::HTTP_BAD_REQUEST
            );
        }

        $this->updateWeather($cities);

        return new JsonResponse(
            data: 'Accepted for processing',
            status: Response::HTTP_ACCEPTED
        );
    }

    private function checkCities(Collection $cities, array $requestedCities): array
    {
        $errors = [];
        foreach ($requestedCities as $city)
        {
            if (!$cities->contains('name', '=', $city)) {
                $errors[] = sprintf('City with name: %s not found', $city);
            }
        }
        return $errors;
    }

    private function updateWeather(Collection $cities): void
    {
        foreach ($cities as $city)
        {
            UpdateCityWeatherTask::dispatch($city->id);
        }
    }
}
