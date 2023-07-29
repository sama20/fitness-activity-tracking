<?php
namespace App\Services;

use App\Models\Activity;
use App\Models\Enums\DistanceUnit;
use Illuminate\Database\Eloquent\Collection;

class ActivityService
{
    public function __construct(public Activity $activityModel)
    {
    }

    public function getAllActivities(): Collection
    {
        return $this->activityModel->getAllActivities();
    }

    public function getActivitiesByType(string $type): Collection
    {
        return $this->activityModel->getActivitiesByType($type);
    }

    public function getTotalDistanceByType(string $type): float|int
    {
        $activities = $this->activityModel->getActivitiesByType($type);

        $totalDistance = 0;
        foreach ($activities as $activity) {
            $rate = DistanceUnit::tryFrom($activity->distance_unit)->rate();
            $totalDistance += $rate * $activity->distance;
        }

        return $totalDistance;
    }

    public function getTotalTimeByType(string $type): string
    {
        $totalTimeInSeconds = $this->activityModel->sumElapsedTimeByType($type);

        $hours = floor($totalTimeInSeconds / 3600);
        $minutes = floor(($totalTimeInSeconds - ($hours * 3600)) / 60);
        $seconds = $totalTimeInSeconds - ($hours * 3600) - ($minutes * 60);

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function storeActivity(array $data): Activity
    {
        return $this->activityModel->storeActivity($data);
    }
}
