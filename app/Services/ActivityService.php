<?php
namespace App\Services;

use App\Contracts\IService;
use App\Helpers\Utility;
use App\Models\Activity;
use App\Models\Enums\DistanceUnit;
use Illuminate\Database\Eloquent\Collection;

class ActivityService implements IService
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
            $totalDistance += $this->getDistanceByMeter($activity);
        }

        return $totalDistance;
    }

    public function getTotalTimeByType(string $type): string
    {
        $totalTimeInSeconds = $this->activityModel->sumElapsedTimeByType($type);

        return Utility::secondToDuration($totalTimeInSeconds);
    }

    public function storeActivity(ActivityDTO $activityData): Activity
    {
        $data = $this->transformActivityDataToArray($activityData);

        return $this->activityModel->storeActivity($data);
    }

    public function getDistanceByMeter(mixed $activity): int|float
    {
        $rate = DistanceUnit::tryFrom($activity->distance_unit)->rate();

        return $rate * $activity->distance;
    }

    /** NOTE:
     * It is good in future to consider an ActivityRepository and move transformActivityDataToArray there.
     */
    private function transformActivityDataToArray(ActivityDTO $activityData): array
    {
        return [
            'activity_type' => $activityData->getActivityType(),
            'activity_date' => $activityData->getActivityDate(),
            'name' => $activityData->getName(),
            'distance' => $activityData->getDistance(),
            'distance_unit' => $activityData->getDistanceUnit(),
            'elapsed_time' => $activityData->getElapsedTime(),
        ];
    }
}
