<?php
namespace App\Services;

use App\DataTransferObjects\ActivityDTO;
use App\Contracts\IService;
use App\Helpers\Utility;
use App\Models\Activity;
use App\Models\Enums\ActivityType;
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

    public function getActivitiesByType(ActivityType $activityType): Collection
    {
        return $this->activityModel->getActivitiesByType($activityType->value);
    }

    public function getTotalDistanceByType(ActivityType $activityType): float|int
    {
        $activities = $this->activityModel->getActivitiesByType($activityType->value);

        $totalDistance = 0;
        foreach ($activities as $activity) {
            $totalDistance += $this->getDistanceByMeter($activity);
        }

        return $totalDistance;
    }

    public function getTotalTimeByType(ActivityType $activityType): string
    {
        $totalTimeInSeconds = $this->activityModel->sumElapsedTimeByType($activityType->value);

        return Utility::secondToDuration($totalTimeInSeconds);
    }

    public function storeActivity(ActivityDTO $activityData): Activity
    {
        $data = $this->transformActivityDataToArray($activityData);

        return $this->activityModel->storeActivity($data);
    }

    public function getDistanceByMeter(mixed $activity): int|float
    {
        $rate = DistanceUnit::tryFrom($activity->distance_unit)?->rate();

        return $rate * $activity->distance;
    }

    /*
     * NOTE: It's good in future to consider an ActivityRepository and move transformActivityDataToArray there.
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
