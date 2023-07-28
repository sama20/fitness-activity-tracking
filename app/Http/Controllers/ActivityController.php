<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityController extends Controller
{

    public function __construct(private Activity $activityModel)
    {
    }

    public function getAllActivities()
    {
        $activities = $this->activityModel->getAllActivities();
        return response()->json($activities);
    }

    public function getActivitiesByType($type)
    {
        $activities = $this->activityModel->getActivitiesByType($type);
        return response()->json($activities);
    }

    public function getTotalDistanceByType($type)
    {
        $totalDistance = $this->activityModel->getTotalDistanceByType($type);
        return response()->json(['total_distance' => $totalDistance]);
    }

    public function getTotalTimeByType($type)
    {
        $totalTime = $this->activityModel->getTotalTimeByType($type);
        return response()->json(['total_time' => $totalTime]);
    }

    public function store(ActivityRequest $request)
    {
        $activity = $this->activityModel->storeActivity($request->validated());
        return response()->json($activity, Response::HTTP_CREATED);
    }
}
