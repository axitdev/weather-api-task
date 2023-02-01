<?php

namespace App\Http\Controllers\Api\Weather;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use Carbon\Carbon;
use Domains\City\Models\City;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class WeatherListController extends Controller
{
    public function __invoke()
    {
        $data = City::query()
            ->whereHas('weather')
            ->whereDate('updated_at', Carbon::today())
            ->with('weather')
            ->get();

        if ($data->count() === 0) {
            return new JsonResponse(
                status: Response::HTTP_NO_CONTENT
            );
        }

        return new JsonResponse(
            data: CityResource::collection($data),
            status: Response::HTTP_OK
        );
    }
}
