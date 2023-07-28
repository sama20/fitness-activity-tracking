<?php

namespace App\Models;

use App\Models\Enums\DistanceUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_type', 'activity_date', 'name', 'distance', 'distance_unit', 'elapsed_time'];

    public function getAllActivities()
    {
        return self::all();
    }

    public function getActivitiesByType($type)
    {
        return self::where('activity_type', $type)->get();
    }

    public function getTotalDistanceByType($type)
    {
        $activities = self::where('activity_type', $type)->get();

        $totalDistance = 0;
        foreach ($activities as $activity) {
            $rate = DistanceUnit::tryFrom($activity->distance_unit)->rate();
            $totalDistance += $rate * $activity->distance;
        }

        return $totalDistance;
    }



    public function storeActivity($data)
    {
        return self::create($data);
    }
}
