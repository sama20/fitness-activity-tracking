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
        return [
            'activity_type' => $this->faker->randomElement(ActivityType::getAllValues()),
            'activity_date' => Carbon::now(),
            'name' => $this->faker->sentence,
            'distance' => $this->faker->randomFloat(2, 1, 10),
            'distance_unit' => $this->faker->randomElement(DistanceUnit::getAllValues()),
            'elapsed_time' => $this->faker->numberBetween(600, 3600),
        ];
    }

}
