<?php
namespace App\Services;

use App\Helpers\Utility;
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
            $totalDistance = $this->getDistanceByMeter($activity);
        }

        return $totalDistance;
    }

    public function getTotalTimeByType(string $type): string
    {
        $totalTimeInSeconds = $this->activityModel->sumElapsedTimeByType($type);

        return Utility::secondToDuration($totalTimeInSeconds);
    }

    public function storeActivity(array $data): Activity
    {
        return $this->activityModel->storeActivity($data);
    }

    public function getDistanceByMeter(mixed $activity): int|float
    {
        $rate = DistanceUnit::tryFrom($activity->distance_unit)->rate();

        return $rate * $activity->distance;
    }
}
