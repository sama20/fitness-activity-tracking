<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ActivityDTO;
use App\Exceptions\ActivityException;
use App\Http\Requests\ActivityRequest;
use App\Models\Enums\ActivityType;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller
{

    public function __construct(
        private readonly ActivityService $activityService,
        private readonly ActivityDTO $activityDTO
    )
    {
    }

    public function getAllActivities(): JsonResponse
    {
        $activities = $this->activityService->getAllActivities();

        return response()->json($activities);
    }

    public function getActivitiesByType(string $type): jsonResponse
    {
        $activityType = ActivityType::tryFrom($type);
        ActivityException::validateActivityType($activityType);

        $activities = $this->activityService->getActivitiesByType($activityType);

        return response()->json($activities);
    }

    public function getTotalDistanceByType(string $type): jsonResponse
    {
        $activityType = ActivityType::tryFrom($type);
        ActivityException::validateActivityType($activityType);

        $totalDistance = $this->activityService->getTotalDistanceByType($activityType);

        return response()->json(['total_distance_in_meter' => (int)$totalDistance]);
    }

    public function getTotalTimeByType(string $type): jsonResponse
    {
        $activityType = ActivityType::tryFrom($type);
        ActivityException::validateActivityType($activityType);

        $totalTime = $this->activityService->getTotalTimeByType($activityType);

        return response()->json(['total_time' => $totalTime]);
    }

    public function store(ActivityRequest $request): jsonResponse
    {
        $activityData = $this->activityDTO->makeActivityDTOFromArray($request->validated());
        $activity = $this->activityService->storeActivity($activityData);

        return response()->json($activity, Response::HTTP_CREATED);
    }
}
