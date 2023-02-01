<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property  string $name
 * @property string $lat
 * @property string $lon
 * @property WeatherResource $weather
 */
class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'name' => $this->name,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'weather' => WeatherResource::make($this->weather),
        ];
    }
}
