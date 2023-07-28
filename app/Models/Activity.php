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

    public function getTotalTimeByType($type)
    {
        $totalTimeInSeconds = self::where('activity_type', $type)->sum('elapsed_time');

        $hours = floor($totalTimeInSeconds / 3600);
        $minutes = floor(($totalTimeInSeconds - ($hours * 3600)) / 60);
        $seconds = $totalTimeInSeconds - ($hours * 3600) - ($minutes * 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function storeActivity($data)
    {
        return self::create($data);
    }
}
