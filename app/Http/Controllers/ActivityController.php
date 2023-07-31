<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\ActivityDTO;
use App\Http\Requests\ActivityRequest;
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
        $activities = $this->activityService->getActivitiesByType($type);

        return response()->json($activities);
    }

    public function getTotalDistanceByType(string $type): jsonResponse
    {
        $totalDistance = $this->activityService->getTotalDistanceByType($type);

        return response()->json(['total_distance' => $totalDistance]);
    }

    public function getTotalTimeByType(string $type): jsonResponse
    {
        $totalTime = $this->activityService->getTotalTimeByType($type);

        return response()->json(['total_time' => $totalTime]);
    }

    public function store(ActivityRequest $request): jsonResponse
    {
        $activityData = $this->activityDTO->makeActivityDTOFromArray($request->validated());
        $activity = $this->activityService->storeActivity($activityData);
        return response()->json($activity, Response::HTTP_CREATED);
    }
}
