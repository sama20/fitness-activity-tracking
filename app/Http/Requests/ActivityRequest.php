<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'activity_type' => 'required|in:running,cycling,walking,swimming,yoga',
            'activity_date' => 'required|date',
            'name' => 'required|string',
            'distance' => 'required|numeric|min:0',
            'distance_unit' => 'required|in:kilometers,miles,meters',
            'elapsed_time' => 'required|integer|min:0',
        ];
    }
}
