<?php

namespace App\Http\Requests\Cities;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $cities
 */
class UpdateCitiesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cities' => ['array', 'required'],
        ];
    }
}
