<?php

namespace App\Http\Requests;

use App\Exceptions\ActivityException;
use App\Models\Enums\ActivityType;
use App\Models\Enums\DistanceUnit;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function rules() : array
    {
        $validActivityTypes = implode(',', ActivityType::getAllValues());
        $validDistanceUnits = implode(',', DistanceUnit::getAllValues());

        return [
            'activity_type' => "required|in:$validActivityTypes",
            'activity_date' => 'required|date',
            'name' => 'required|string',
            'distance' => 'required|numeric|min:0',
            'distance_unit' => "required|in:$validDistanceUnits",
            'elapsed_time' => 'required|integer|min:0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        ActivityException::validateActivity($validator);
    }
}
