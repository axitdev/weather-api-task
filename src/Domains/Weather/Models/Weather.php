<?php

declare(strict_types=1);

namespace Domains\Weather\Models;

use Domains\City\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Weather extends Model
{
    use HasFactory;

    protected $fillable = [
        'temp',
        'city_id',
    ];

    public function city(): BelongsTo
    {
        return $this->BelongsTo(City::class, 'city_id', 'id');
    }
}
