<?php

namespace Database\Factories;

use App\Models\Enums\ActivityType;
use App\Models\Enums\DistanceUnit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        $distanceUnit = $this->faker->randomElement(DistanceUnit::getAllValues());
        return [
            'activity_type' => $this->faker->randomElement(ActivityType::getAllValues()),
            'activity_date' => Carbon::now(),
            'name' => $this->faker->sentence,
            'distance' => $distanceUnit===DistanceUnit::Meter->value
                ? $this->faker->randomFloat(0,100,1000)
                : $this->faker->randomFloat(2, 1, 10) ,
            'distance_unit' => $distanceUnit,
            'elapsed_time' => $this->faker->numberBetween(600, 3600),
        ];
    }

}
