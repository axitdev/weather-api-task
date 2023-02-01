<?php

declare(strict_types=1);

namespace Domains\City\Models;

use Domains\Weather\Models\Weather;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lat',
        'lon',
    ];

    public function weather(): HasOne
    {
        return $this->hasOne(Weather::class, 'city_id', 'id');
    }
}
